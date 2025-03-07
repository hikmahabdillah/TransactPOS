<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', [HomeController::class, 'index']);
