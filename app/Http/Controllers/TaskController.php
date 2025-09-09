<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    // Show all tasks
    public function index(): View
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all()); 
        $validated = $request->validate([
            'title' => 'required|string|max:255',

        ]);
         //$user = auth()->user();
        Task::create([
            'title' => $validated['title'],
            'user_id' => auth()->user()->id(),
            // $request->input('name'),
            'completed' => false,
        ]);

        return redirect()->back()->with('success', 'Task created successfully');
    }

    // Mark a task as completed
    public function update(Task $task): RedirectResponse
    {
        $task->update(['completed' => true]);
        return redirect()->back()->with('success','Task created successfully');
    }

    // Delete a task
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->back();
    }
}
