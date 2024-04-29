<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Endpoints API:
// Accès publique page de connexion v1 :
Route::get('/v1/welcome', [WelcomeController::class, 'apiIndex']);

// Users v1 :
Route::get('/v1/users', function () {
    return 'Récupérer la liste des utilisateurs.';
});

Route::get('/v1/users/{id}', function ($id) {
    return 'Récupérer un utilisateur spécifique par son identifiant: ' . $id;
});

Route::post('/v1/users', function () {
    return 'Créer un nouvel utilisateur.';
});

Route::put('/v1/users/{id}', function ($id) {
    return 'Mettre à jour les informations d\'un utilisateur existant: ' . $id;
});

Route::delete('/v1/users/{id}', function ($id) {
    return 'Supprimer un utilisateur existant: ' . $id;
});

Route::post('/v1/login', function () {
    return 'Endpoint pour l\'authentification.';
});

Route::post('/v1/register', function () {
    return 'Endpoint pour l\'inscription d\'un nouvel utilisateur.';
});

// Products v1 :
Route::get('/v1/products', function () {
    return 'Récupérer la liste des produits.';
});

Route::get('/v1/products/{id}', function ($id) {
    return 'Récupérer un produit spécifique par son identifiant: ' . $id;
});

Route::post('/v1/products', function () {
    return 'Créer un nouveau produit.';
});

Route::put('/v1/products/{id}', function ($id) {
    return 'Mettre à jour les informations d\'un produit existant: ' . $id;
});

Route::delete('/v1/products/{id}', function ($id) {
    return 'Supprimer un produit existant: ' . $id;
});

// Catégories v1 :
Route::get('/v1/categories', function () {
    return 'Récupérer la liste des catégories.';
});

Route::get('/v1/categories/{id}', function ($id) {
    return 'Récupérer une catégorie spécifique par son identifiant: ' . $id;
});

Route::post('/v1/categories', function () {
    return 'Créer une nouvelle catégorie.';
});

Route::put('/v1/categories/{id}', function ($id) {
    return 'Mettre à jour les informations d\'une catégorie existante: ' . $id;
});

Route::delete('/v1/categories/{id}', function ($id) {
    return 'Supprimer une catégorie existante: ' . $id;
});

// Route test
Route::get('/v1/test', function () {
    return 'test';
});