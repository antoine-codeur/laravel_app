<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::get('/v1/welcome', function () {
    return response()->json(['message' => 'Welcome to our API!']);
});

Route::post('/v1/register', [UserController::class, 'register']); //fonctionnel
Route::post('/v1/login', [UserController::class, 'login']); //fonctionnel

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/logout', [UserController::class, 'logout']); //fonctionnel

    // User routes
    Route::get('/v1/users', [UserController::class, 'index']); //fonctionnel
    Route::get('/v1/users/{id}', [UserController::class, 'show']); //fonctionnel
    Route::post('/v1/users', [UserController::class, 'register']); //fonctionnel
    Route::put('/v1/users/{id}', [UserController::class, 'update']); //fonctionnel
    Route::delete('/v1/users/{id}', [UserController::class, 'destroy']); //fonctionnel

    // Product routes
    Route::get('/v1/products', [ProductApiController::class, 'index']); //fonctionnel
    Route::get('/v1/products/{id}', [ProductApiController::class, 'show']); //fonctionnel
    Route::post('/v1/products', [ProductApiController::class, 'store']); //fonctionnel
    Route::put('/v1/products/{id}', [ProductApiController::class, 'update']); //fonctionnel
    Route::delete('/v1/products/{id}', [ProductApiController::class, 'destroy']); //fonctionnel

    // Category routes
    Route::get('/v1/categories', [CategoryApiController::class, 'index']); //fonctionnel
    Route::get('/v1/categories/{id}', [CategoryApiController::class, 'show']); //fonctionnel
    Route::post('/v1/categories', [CategoryApiController::class, 'store']); //fonctionnel
    Route::put('/v1/categories/{id}', [CategoryApiController::class, 'update']); //fonctionnel
    Route::delete('/v1/categories/{id}', [CategoryApiController::class, 'destroy']); //fonctionnel
});