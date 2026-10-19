<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;

Route::get("/", [DashboardController::class,"index"]);
Route::get('/about', [AboutController::class, "index"]);
