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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// ROUTE POUR L'AUTHENTIFICATION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);



//ROUTE POUR CATEGORIES
Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::put('/categories/{categorie}', [CategorieController::class, 'update']);
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy']);



//ROUTE POUR PRODUITS
Route::get('/produits', [ProduitController::class, 'index']);
Route::post('/produits', [ProduitController::class, 'store']);
Route::get('/produits/{produit}', [ProduitController::class, 'show']);
Route::put('/produits/{produit}', [ProduitController::class, 'update']);
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy']);

//ROUTE POUR LES PRESTATIONS
Route::get('/prestations', [PrestationController::class, 'index']);
Route::post('/prestations', [PrestationController::class, 'store']);
Route::get('/prestations/{prestation}', [PrestationController::class, 'show']);
Route::put('/prestations/{prestation}', [PrestationController::class, 'update']);
Route::delete('/prestations/{prestation}', [PrestationController::class, 'destroy']);

//ROUTE POUR LES TEMOIGNAGES
Route::get('/temoignages', [TemoignageController::class, 'index']);
Route::post('/temoignages', [TemoignageController::class, 'store']);
Route::get('/temoignages/{temoignage}', [TemoignageController::class, 'show']);
Route::put('/temoignages/{temoignage}', [TemoignageController::class, 'update']);
Route::delete('/temoignages/{temoignage}', [TemoignageController::class, 'destroy']);


//ROUTE POUR LES COMMANDES

Route::get('/commandes', [CommandeController::class, 'index']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::get('/commandes/{commande}', [CommandeController::class, 'show']);
Route::put('/commandes/{commande}', [CommandeController::class, 'update']);
Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy']);



//ROUTE POUR LES PROPRESTATIONS
Route::get('/proprestations', [ProprestationController::class, 'index']);
Route::post('/proprestations', [ProprestationController::class, 'store']);
Route::put('/proprestations/{proprestation}', [ProprestationController::class, 'update']);
Route::delete('proprestations/{proprestation}', [ProprestationController::class, 'destroy']);


//ROUTE POUR LES RESERVATIONS
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);
