<?php

use App\Http\Controllers\CategorieController;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//ROUTE POUR CATEGORIE
Route::get('/categories', [CategorieController::class, "index"]);
Route::post('/categories', [CategorieController::class, "store"]);
Route::put('/categories/{id}', [CategorieController::class, "update"]);
Route::delete('/categories/{id}', [CategorieController::class, "destroy"]);
Route::delete('/categories/{id}', [CategorieController::class, "destroy"]);

