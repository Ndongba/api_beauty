<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ProduitController;
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

//ROUTE POUR LE SPRESTATIONS
Route::get('/prestations', [PrestationController::class, "index"]);
Route::post('/prestations', [PrestationController::class, "store"]);
Route::put('/prestations/{id}', [PrestationController::class, "update"]);
