<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard", [
            'name' => 'Souyan Zakharov',
            'project' => 'Laravel Starter',
            'stack' => ['PHP', 'Laravel', 'Vite', 'TailwindCSS'],
            'tasks' => Task::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);

        Task::create($validated);

        return redirect('/')->with('success','Task created successfully!');
    }
}
