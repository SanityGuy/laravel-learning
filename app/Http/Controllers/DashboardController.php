<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard", [
            'name' => 'Souyan Zakharov',
            'project' => 'Laravel Starter',
            'stack' => ['PHP', 'Laravel', 'Vite', 'TailwindCSS'],
        ]);
    }
}
