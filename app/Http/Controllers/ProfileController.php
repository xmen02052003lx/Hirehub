<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // @desc    Update profile info
    // @route   PUT /profile
    public function update(Request $request): RedirectResponse
    {
        // Get logged in user
        $user = Auth::user();

        // Validate data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);
        if ($request->file('avatar')) {
            // Delete old logo
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . basename($user->avatar));
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }
        $user->update($validatedData);
        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
