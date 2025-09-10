<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['title' => 'required|string|max:255']);

        Task::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'completed' => false,
        ]);

        return back()->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update(['completed' => !$task->completed]);
        return back()->with('success', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();
        return back()->with('success', 'Task deleted.');
    }
}