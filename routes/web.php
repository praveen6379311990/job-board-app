<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobSeeker\DashboardController;
use App\Http\Controllers\JobSeeker\PasswordController;
use App\Http\Controllers\JobSeeker\ProfileController as JobSeekerProfileController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::get('/register/jobseeker', [JobSeekerController::class, 'showRegisterForm']);
Route::post('/register/jobseeker', [JobSeekerController::class, 'register']);

Route::get('/login/jobseeker', [JobSeekerController::class, 'showLoginForm']);
Route::post('/login/jobseeker', [JobSeekerController::class, 'login']);

Route::get('/login/admin', [AdminController::class, 'showLoginForm']);
Route::post('/login/admin', [AdminController::class, 'login']);

Route::middleware(['auth:jobseeker'])->prefix('jobseeker')->name('jobseeker.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Edit
    Route::get('/profile/edit', [JobSeekerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [JobSeekerProfileController::class, 'update'])->name('profile.update');

    // Change Password
    Route::get('/password/change', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');
});

require __DIR__.'/auth.php';
