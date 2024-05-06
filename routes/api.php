<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\CategoryApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User routes
Route::get('/v1/users', [UserApiController::class, 'index']);
Route::get('/v1/users/{id}', [UserApiController::class, 'show']);
Route::post('/v1/users', [UserApiController::class, 'store']);
Route::put('/v1/users/{id}', [UserApiController::class, 'update']);
Route::delete('/v1/users/{id}', [UserApiController::class, 'destroy']);
Route::post('/v1/login', [UserApiController::class, 'login']);
Route::post('/v1/register', [UserApiController::class, 'register']);

// Product routes
Route::get('/v1/products', [ProductApiController::class, 'index']);
Route::get('/v1/products/{id}', [ProductApiController::class, 'show']);
Route::post('/v1/products', [ProductApiController::class, 'store']);
Route::put('/v1/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/v1/products/{id}', [ProductApiController::class, 'destroy']);

// Category routes
Route::get('/v1/categories', [CategoryApiController::class, 'index']);
Route::get('/v1/categories/{id}', [CategoryApiController::class, 'show']);
Route::post('/v1/categories', [CategoryApiController::class, 'store']);
Route::put('/v1/categories/{id}', [CategoryApiController::class, 'update']);
Route::delete('/v1/categories/{id}', [CategoryApiController::class, 'destroy']);