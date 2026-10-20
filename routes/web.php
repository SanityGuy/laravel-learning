<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Models\Task;

Route::get("/", [DashboardController::class,"index"]);
Route::get('/about', [AboutController::class, "index"]);
Route::post('/tasks', [DashboardController::class,'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [DashboardController::class,'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [DashboardController::class,'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [DashboardController::class,'destroy'])->name('tasks.destroy');
Route::patch('/tasks/{task}/status', [DashboardController::class,'setStatus'])->name('tasks.status');
