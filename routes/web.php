
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/about', [AboutController::class, 'index'])->name('about');

    Route::post('/tasks', [DashboardController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/{task}/edit', [DashboardController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/tasks/{task}', [DashboardController::class, 'update'])
        ->name('tasks.update');

    Route::patch('/tasks/{task}/status', [DashboardController::class, 'setStatus'])
        ->name('tasks.status');

    Route::delete('/tasks/{task}', [DashboardController::class, 'destroy'])
        ->name('tasks.destroy');
});
