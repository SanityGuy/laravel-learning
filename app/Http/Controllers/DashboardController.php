<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'name' => auth()->user()->name,
            'project' => 'Laravel Starter',
            'stack' => ['PHP', 'Laravel', 'Vite', 'TailwindCSS'],
            'tasks' => auth()->user()->tasks()->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        $request->user()->tasks()->create($validated);

        return redirect('/')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $task = auth()->user()->tasks()->findOrFail($task->id);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task = $request->user()->tasks()->findOrFail($task->id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return redirect('/')->with('success', 'Task updated successfully!');
    }

    public function setStatus(Request $request, Task $task)
    {
        $task = $request->user()->tasks()->findOrFail($task->id);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,completed'],
        ]);

        $task->update($validated);

        return redirect('/')->with('success', 'Task status updated successfully!');
    }

    public function destroy(Request $request, Task $task)
    {
        $task = $request->user()->tasks()->findOrFail($task->id);

        $task->delete();

        return redirect('/')->with('success', 'Task deleted successfully!');
    }
}
