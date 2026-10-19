<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Models\Task;

Route::get("/", [DashboardController::class,"index"]);
Route::get('/about', [AboutController::class, "index"]);
Route::post('/tasks', [DashboardController::class,'store'])->name('tasks.store');
