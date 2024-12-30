<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobController extends Controller
{
    // @desc Show all job listings
    // @route GET /jobs
    public function index(): View
    {
        $jobs = Job::latest()->paginate(9);
        return view('jobs.index', compact('jobs'));
    }

    // @desc Show create job form
    // @route GET /jobs/create
    public function create(): View
    {
        return view('jobs.create');
    }

    // @desc Save job to database
    // @route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);
        $validatedData['user_id'] = auth()->user()->id;

        if ($request->file('company_logo')) {
            $path = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $path;
        }
        Job::create($validatedData);

        //         It depends on how you use the with method and on what class. For example when you call the method redirect() the class \Illuminate\Http\RedirectResponse is used. This method has a with function that will add a key value item to the session for that redirect.
        // Documentation: https://laravel.com/api/5.6/Illuminate/Http/RedirectResponse.html#method_with
        // However, when you use the with method on the view() method it will add a key and value item to the view. This way you can use that variable in your blade files
        // Documentation: https://laravel.com/api/5.6/Illuminate/View/View.html#method_with
        // So the with method is used on multiple places, but it depends on the class you call it on!
        return redirect()->route('jobs.index')->with('success', 'Job created');
    }

    // @desc Display a single job listing
    // @route GET /jobs/{$job}
    // This is called "model binding"
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    // @desc Show edit job form
    // @route GET /jobs/{$job}/edit
    public function edit(Job $job, Request $request): View
    {
        if ($request->user()->cannot('update', $job)) {
            abort(403);
        }
        return view('jobs.edit')->with('job', $job);
    }

    // @desc Update job listing
    // @route PUT /jobs/{$job}
    public function update(Request $request, Job $job): RedirectResponse
    {
        if ($request->user()->cannot('update', $job)) {
            abort(403);
        }
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|string',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'company_website' => 'nullable|url',
        ]);

        if ($request->file('company_logo')) {
            // Delete old logo
            Storage::disk('public')->delete('logos/' . basename($job->company_logo));

            $path = $request->file('company_logo')->store('logos', 'public');
            $validatedData['company_logo'] = $path;
        }
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated');
    }

    // @desc Delete a job listing
    // @route DELETE /jobs/{$job}
    public function destroy(Job $job, Request $request): RedirectResponse
    {
        if ($request->user()->cannot('update', $job)) {
            abort(403);
        }
        if ($job->company_logo) {
            Storage::disk('public')->delete('logos/' . basename($job->company_logo));
        }
        $job->delete();
        // Check if request came from the dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }
        return redirect()->route('jobs.index')->with('success', 'Job deleted');
    }

    // @desc    Search job listings
    // @route   GET /jobs/search
    public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(description) like ?', ['%' . $keywords . '%'])
                    ->orWhereRaw('LOWER(tags) like ?', ['%' . $keywords . '%']);
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw('LOWER(address) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(city) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(state) like ?', ['%' . $location . '%'])
                    ->orWhereRaw('LOWER(zipcode) like ?', ['%' . $location . '%']);
            });
        }

        $jobs = $query->paginate(12);

        return view('jobs.index')->with('jobs', $jobs);
    }
}
