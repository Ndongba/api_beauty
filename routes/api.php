<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\TemoignageController;
use App\Models\Categorie;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//ROUTE POUR CATEGORIES
Route::get('/categories', [CategorieController::class, "index"]);
Route::post('/categories', [CategorieController::class, "store"]);
Route::put('/categories/{id}', [CategorieController::class, "update"]);
Route::delete('/categories/{id}', [CategorieController::class, "destroy"]);
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
