<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route; // this Route Facade is basically a class that has a bunch of method in it, including "get"

// the 2nd param is called "closure" is a function that pass in another function, (i think it's like callback)
// Link routes to Controllers
Route::get('/', [HomeController::class, 'index'])->name('home');
// we have to put the search route here because order matters, we dont want the "/search" part to be treated as an "id"
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index')->middleware('auth');
Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store')->middleware('auth');
Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy')->middleware('auth');
Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth');
