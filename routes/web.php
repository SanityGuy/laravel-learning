<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Models\Task;

Route::get("/", [DashboardController::class,"index"]);
Route::get('/about', [AboutController::class, "index"]);
Route::get('/setup-task', function () {
    Task::create([
        'title' => 'Build my first Laravel application',
        'description' => 'Learn Eloquent and database operations.',
        'status' => 'in_progress',
    ]);

    return 'Task created successfully!';
});
