<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    // @desc Show login form
    // @route GET /login
    public function login(): View
    {
        return view('auth.login');
    }
    // @desc Register new user
    // @route POST /register
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate(['email' => 'required|string|email', 'password' => 'required|string']);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    // @desc Logout user
    // @route POST /logout
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
