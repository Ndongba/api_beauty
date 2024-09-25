<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Categorie::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie = new Categorie();
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->save();
        return response()->json($categorie);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categorie = new Categorie();
        $categorie->libelle = $request->libelle;
        $categorie->description = $request->description;
        $categorie->update();
        return response()->json($categorie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie, $id)
    {

     // Trouver la catégorie par ID
    $categorie = Categorie::find($id);

    // Vérifier si la catégorie existe
    if (!$categorie) {
        return response()->json(['message' => 'Categorie not found'], 404);
    }

    // Supprimer la catégorie
    $categorie->delete();

    // Retourner une réponse de succès
    return response()->json(['message' => 'Categorie deleted successfully']);

    }
}
