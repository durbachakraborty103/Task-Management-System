<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// ----------------- Public Route -----------------
Route::get('/', function () {
    return view('welcome'); // Show welcome page
});

// ----------------- Dashboard (only for logged-in + verified users) -----------------
Route::get('/dashboard', function () {
    return view('dashboard'); // Show dashboard page
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------- Routes for Logged-in Users -----------------
Route::middleware('auth')->group(function () {
    // ----- Profile Routes -----
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete profile

    // ----- Task Routes -----
    Route::resource('tasks', TaskController::class); // All CRUD routes for tasks (index, create, store, edit, update, destroy)
    Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete'); // Mark task as complete
});

// ----------------- Include Authentication Routes -----------------
require __DIR__ .'/auth.php';