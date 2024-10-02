<?php

use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ImageProduitController;
use App\Http\Controllers\ProprestationController;
use App\Http\Controllers\ImageProfessionnelController;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::apiResource('images-produits', ImageProduitController::class);
Route::apiResource('images-professionnels', ImageProfessionnelController::class);

// ROUTE POUR L'AUTHENTIFICATION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/me', [AuthController::class, 'me']);

// // Routes accessibles uniquement pour les administrateurs
 Route::middleware(['auth:api', 'role:admin'])->group(function () {
     Route::get('/admin', [AuthController::class, 'index']);
     Route::resource('prestations', PrestationController::class);

     //ROUTE POUR LES PROPRESTATIONS
    Route::get('/proprestations', [ProprestationController::class, "index"]);
    Route::post('/proprestations', [ProprestationController::class, "store"]);
    Route::put('/proprestations/{id}', [ProprestationController::class, "update"]);
    Route::delete('proprestations/{proprestation}', [ProprestationController::class, 'destroy']);
 });

// // Routes accessibles pour les professionnels
 Route::middleware(['auth:api','role:professionnel'])->group(function () {
     Route::get('/professionnel/dashboard', [PrestationController::class, 'dashboard']);
     Route::post('/prestations/create', [PrestationController::class, 'store']);

     //ROUTE POUR LES PRESTATIONS
    Route::get('/prestations', [PrestationController::class, "index"]);
    Route::post('/prestations', [PrestationController::class, "store"]);
    Route::get('/prestations/{prestation}', [PrestationController::class, "show"]);
    Route::put('/prestations/{id}', [PrestationController::class, "update"]);
    Route::delete('/prestations/{id}', [PrestationController::class, "destroy"]);

    //ROUTE POUR PRODUITS
    Route::get('/produits', [ProduitController::class, "index"]);
    Route::post('/produits', [ProduitController::class, "store"]);
    Route::get('/produits/{produit}', [ProduitController::class, "show"]);
    Route::put('/produits/{id}', [ProduitController::class, "update"]);
    Route::delete('/produits/{id}', [ProduitController::class, "destroy"]);
//ROUTE POUR CATEGORIES
Route::get('/categories', [CategorieController::class, 'index']);
Route::post('/categories', [CategorieController::class, 'store']);
Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categorie.update');
Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy']);

 });

// // Routes accessibles uniquement pour les clients
 Route::middleware(['auth:api' ,'role:client'])->group(function () {
     Route::get('/reservations', [ReservationController::class, 'index']);
     Route::post('/reservations/store', [ReservationController::class, 'store']);


     //ROUTE POUR LES COMMANDES
    Route::get('/commandes', [CommandeController::class, "index"]);
    Route::post('/commandes', [CommandeController::class, "store"]);
    Route::put('/commandes/{id}', [CommandeController::class, "update"]);
    Route::delete('/commandes/{id}', [CommandeController::class, "destroy"]);
    Route::get('/commandes/{commande}', [CommandeController::class, "show"]);

    //ROUTE POUR LES RESERVATIONS
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::post('/reservations/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);

    //ROUTE POUR LES TEMOIGNAGES
    Route::get('/temoignages', [TemoignageController::class, "index"]);
    Route::post('/temoignages', [TemoignageController::class, "store"]);
    Route::put('/temoignages/{id}', [TemoignageController::class, "update"]);
    Route::delete('/temoignages/{id}', [TemoignageController::class, "destroy"]);
    Route::get('/temoignages/{temoignage}', [TemoignageController::class, "show"]);
 });
















