<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;

class BookmarkController extends Controller
{
    // @desc Show all users' bookmarks
    // @route GET /bookmarks
    public function index(): View
    {
        $user = Auth::user();
        $bookmarks = $user->bookMarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);
        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }
    // @desc Create bookmark
    // @route POST /bookmarks/{job}
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();
        if ($user->bookMarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is already bookmarked');
        }
        $user->bookMarkedJobs()->attach($job->id);
        return back()->with('success', 'Job bookmarked');
    }
    // @desc Delete bookmark
    // @route DELETE /bookmarks/{job}
    public function destroy(Job $job): RedirectResponse
    {
        $user = Auth::user();
        if (!$user->bookMarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'Job is not bookmarked');
        }
        $user->bookMarkedJobs()->detach($job->id);
        return back()->with('success', 'Bookmark removed');
    }
}
