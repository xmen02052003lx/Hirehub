<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // @desc Show register form
    // @route GET /register
    public function register(): View
    {
        return view('auth.register');
    }
    // @desc Register new user
    // @route POST /register
    public function store(Request $request): RedirectResponse
    {
        // what "confirmed" does is it automatically look up the field named "password_confirmation" and compare with the "password" field
        $validatedData = $request->validate(['name' => 'required|string|max:100', 'email' => 'required|string|email|max:100|unique:users', 'password' => 'required|string|min:8|confirmed']);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('login')->with('success', 'You are registered and  can login');
    }
}
