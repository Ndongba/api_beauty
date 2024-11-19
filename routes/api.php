<?php

use App\Models\Commande;
use App\Models\Categorie;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MailBeauteController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ImageProduitController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\ProfessionnelController;
use App\Http\Controllers\ProprestationController;
use App\Http\Controllers\ImageProfessionnelController;

 Route::get('/user', function (Request $request) {
     return $request->user();
 })->middleware('auth:sanctum');




// ROUTE POUR L'AUTHENTIFICATION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/roles', [AuthController::class,'index']);
Route::get('/professionnels', [ProfessionnelController::class, 'index']);
Route::get('/professionnels/{id}', [ProfessionnelController::class, 'show']);
Route::apiResource('clients', ClientController::class);
Route::post('mailbeaute', [MailBeauteController::class, 'index']);
// Route::apiResource('/disponibilites/professionnel{professionnelId}', DisponibiliteController::class);
Route::get('/disponibilites/professionnel/{professionnelId}', [DisponibiliteController::class, 'getByProfessionnel']);
Route::get('professionnels/{id}/images', [ImageProfessionnelController::class, 'getImagesByProfessionnel']);
Route::get('/proprestations/{id}', [ProprestationController::class, 'getProprestationDetails']);
Route::get('/reservations/client', [ReservationController::class, 'index']);





Route::middleware(['auth:api'])-> group(function(){
    Route::get('/me', [AuthController::class, 'me']);
});

// // Routes accessibles uniquement pour les administrateurs
 Route::middleware(['auth','role:admin'])->group(function () {
     Route::get('/admin', [AuthController::class, 'index']);
     Route::apiResource('prestations', PrestationController::class);
     Route::apiResource('images-produits', ImageProduitController::class);

     Route::apiResource('produits', ProduitController::class);
     Route::apiResource('commandes', CommandeController::class);
     Route::apiResource('categories', CategorieController::class);
    // Route::apiResource('reservations', ReservationController::class);
     Route::apiResource('temoignages', TemoignageController::class);
     Route::post('/logout', [AuthController::class, 'logout']);

});

// // Routes accessibles pour les professionnels
 Route::middleware(['auth','role:professionnel'])->group(function () {
     Route::get('/professionnel/dashboard', [PrestationController::class, 'dashboard']);
     Route::post('/prestations/create', [PrestationController::class, 'store']);
     Route::apiResource('proprestations', ProprestationController::class);
     Route::post('/logout', [AuthController::class, 'logout']);
     //ROUTE POUR LES PRESTATIONS
    Route::get('/prestations', [PrestationController::class, "index"]);
    Route::post('/prestations', [PrestationController::class, "store"]);
    Route::get('/prestations/{prestation}', [PrestationController::class, "show"]);
    Route::put('/prestations/{id}', [PrestationController::class, "update"]);
    Route::delete('/prestations/{id}', [PrestationController::class, "destroy"]);
    Route::get('/prestations/populaires', [PrestationController::class, 'getPopularPrestations']);


    //ROUTE POUR LES PROFESSIONNELS
    Route::get('/reservations/professionnel', [ReservationController::class, "getReservationsByProfessionnel"]);
    Route::get('/reservations/client', [ReservationController::class, 'index']);
    Route::get('/reservations/clientpro', [ReservationController::class,'getClientsPros']);
    Route::get('/reservations/client', [ReservationController::class, 'index']);

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

//ROUTE POUR UPLOAD IMAGES
Route::apiResource('images-produits', ImageProduitController::class);
Route::apiResource('images-professionnels', ImageProfessionnelController::class);


 });

// // Routes accessibles uniquement pour les clients
  Route::middleware(['auth', 'role:client'])->group(function () {

//      //ROUTE POUR LES COMMANDES
     Route::get('/commandes', [CommandeController::class, "index"]);
     Route::post('/commandes', [CommandeController::class, "store"]);
     Route::put('/commandes/{id}', [CommandeController::class, "update"]);
     Route::delete('/commandes/{id}', [CommandeController::class, "destroy"]);
     Route::get('/commandes/{commande}', [CommandeController::class, "show"]);

//     //ROUTE POUR LES RESERVATIONS
    Route::get('/reservations/client', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);
//
    Route::get('/professionnel/prestations/{professionnelId}', [PrestationController::class, 'listePrestationParProf']);

//     //ROUTE POUR LES TEMOIGNAGES
     Route::get('/temoignages', [TemoignageController::class, "index"]);
     Route::post('/temoignages', [TemoignageController::class, "store"]);
     Route::put('/temoignages/{id}', [TemoignageController::class, "update"]);
     Route::delete('/temoignages/{id}', [TemoignageController::class, "destroy"]);
     Route::get('/temoignages/{temoignage}', [TemoignageController::class, "show"]);
     Route::post('/logout', [AuthController::class, 'logout']);
  });













