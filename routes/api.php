<?php

use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ProprestationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TemoignageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ROUTE POUR L'AUTHENTIFICATION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);



//ROUTE POUR CATEGORIES
Route::get('/categories', [CategorieController::class, "index"]);
Route::post('/categories', [CategorieController::class, "store"]);
Route::put('/categories/{id}', [CategorieController::class, "update"]);
Route::delete('/categories/{id}', [CategorieController::class, "destroy"]);



//ROUTE POUR PRODUITS
Route::get('/produits', [ProduitController::class, "index"]);
Route::post('/produits', [ProduitController::class, "store"]);
Route::get('/produits/{produit}', [ProduitController::class, "show"]);
Route::put('/produits/{id}', [ProduitController::class, "update"]);
Route::delete('/produits/{id}', [ProduitController::class, "destroy"]);

//ROUTE POUR LES PRESTATIONS
Route::get('/prestations', [PrestationController::class, "index"]);
Route::post('/prestations', [PrestationController::class, "store"]);
Route::get('/prestations/{prestation}', [PrestationController::class, "show"]);
Route::put('/prestations/{id}', [PrestationController::class, "update"]);
Route::delete('/prestations/{id}', [PrestationController::class, "destroy"]);

//ROUTE POUR LES TEMOIGNAGES
Route::get('/temoignages', [TemoignageController::class, "index"]);
Route::post('/temoignages', [TemoignageController::class, "store"]);
Route::put('/temoignages/{id}', [TemoignageController::class, "update"]);
Route::delete('/temoignages/{id}', [TemoignageController::class, "destroy"]);
Route::get('/temoignages/{temoignage}', [TemoignageController::class, "show"]);

//ROUTE POUR LES COMMANDES

Route::get('/commandes', [CommandeController::class, "index"]);
Route::post('/commandes', [CommandeController::class, "store"]);
Route::put('/commandes/{id}', [CommandeController::class, "update"]);
Route::delete('/commandes/{id}', [CommandeController::class, "destroy"]);
Route::get('/commandes/{commande}', [CommandeController::class, "show"]);


//ROUTE POUR LES PROPRESTATIONS
Route::get('/proprestations', [ProprestationController::class, "index"]);
Route::post('/proprestations', [ProprestationController::class, "store"]);
Route::put('/proprestations/{id}', [ProprestationController::class, "update"]);
Route::delete('proprestations/{proprestation}', [ProprestationController::class, 'destroy']);


//ROUTE POUR LES RESERVATIONS
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::post('/reservations/{id}', [ReservationController::class, 'update'])->name('reservation.update');
