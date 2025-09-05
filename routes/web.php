<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\View\View;

Route::get('/', function (): View {
    return view('welcome');
});

// Corrected task routes:
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

require __DIR__.'/auth.php';