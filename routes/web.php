<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', [HomeController::class, 'index']);

// LEVEL
Route::get('/level', [LevelController::class, 'index']);

// KATEGORI
Route::get('/kategori', [KategoriController::class, 'index']);

// USER
Route::get('/user', [UserController::class, 'index']);

// PRODUCTS
Route::prefix('category')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);

    Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductsController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductsController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductsController::class, 'babyKid']);
});

// USER
Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

// TRANSACTION
Route::get('/transaction', [TransactionController::class, 'index']);
