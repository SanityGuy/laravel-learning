<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get("/", [DashboardController::class,"index"]);
Route::get('/about', function() {
    return view('about', [
        'title' => 'About Page',
        'description' => 'This is the about page of the project.',
    ]);
});
