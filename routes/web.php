<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Artisan;

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
    Route::patch('/tasks/{task}/mark-incomplete', [TaskController::class, 'markIncomplete'])->name('tasks.mark-incomplete');
});

// ----------------- Include Authentication Routes -----------------
require __DIR__ .'/auth.php';

// ===================== TEST ROUTES FOR DUE NOTIFICATIONS =====================
// These are only for testing and don't affect your main application

// Test route to create a due task
Route::get('/test-due-notification', function () {
    $user = User::first();
    
    if (!$user) {
        return "No user found. Please create a user first.";
    }

    $task = Task::create([
        'title' => 'Test Due Task - ' . now()->format('H:i:s'),
        'due_date' => now()->subMinutes(5), // 5 minutes ago (overdue)
        'completed' => false,
        'user_id' => $user->id,
        'reminder_sent' => false,
        'priority' => 'high'
    ]);

    return response()->json([
        'message' => 'Test task created successfully!',
        'task' => [
            'id' => $task->id,
            'title' => $task->title,
            'due_date' => $task->due_date->format('Y-m-d H:i:s'),
            'user' => $user->email,
            'reminder_sent' => $task->reminder_sent
        ]
    ]);
});

// Test route to run the due reminders command
Route::get('/test-send-reminders', function () {
    Artisan::call('tasks:send-due-reminders');
    
    return response()->json([
        'message' => 'Due reminders command executed!',
        'output' => Artisan::output()
    ]);
});

// All-in-one test route
Route::get('/test-complete-system', function () {
    $user = User::first();
    
    if (!$user) {
        return "No user found.";
    }

    // Create test task
    $task = Task::create([
        'title' => 'Auto Test Due Task',
        'due_date' => now()->subMinutes(2),
        'completed' => false,
        'user_id' => $user->id,
        'reminder_sent' => false,
        'priority' => 'high'
    ]);

    // Run the command
    Artisan::call('tasks:send-due-reminders');
    $output = Artisan::output();

    return response()->json([
        'task_created' => [
            'id' => $task->id,
            'title' => $task->title,
            'user' => $user->email
        ],
        'command_output' => $output
    ]);
});