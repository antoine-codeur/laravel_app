<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoints API:

use App\Http\Controllers\WelcomeController;
// Accès publique page de connexion v1 :
Route::get('/v1/welcome', [WelcomeController::class, 'apiIndex']);

use App\Http\Controllers\API\UserController;
// Users v1 :
Route::apiResource('v1/users', UserController::class); //revoir update


Route::post('/v1/login', function () {
    return 'Endpoint pour l\'authentification.';
});

Route::post('/v1/register', function () {
    return 'Endpoint pour l\'inscription d\'un nouvel utilisateur.';
});


use App\Http\Controllers\API\ProductController;
// Products v1 :
Route::apiResource('v1/products', ProductController::class);

use App\Http\Controllers\API\CategoryController;
// Catégories v1 :
Route::apiResource('v1/categories', CategoryController::class);