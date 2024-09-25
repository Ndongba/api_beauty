<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemoignageRequest;
use App\Http\Requests\UpdateTemoignageRequest;
use App\Models\Temoignage;

class TemoignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Temoignage::all());
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
    public function store(StoreTemoignageRequest $request)
    {
        $temoignage = new temoignage();
        $temoignage->titre = $request->titre;
        $temoignage->contenu = $request->contenu;
        $temoignage->client_id = $request->client_id;
        $temoignage->save();
        return response()->json($temoignage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Temoignage $temoignage)
    {
        return response()->json($temoignage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temoignage $temoignage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemoignageRequest $request, Temoignage $temoignage)
    {
        $temoignage = new temoignage();
        $temoignage->titre = $request->titre;
        $temoignage->contenu = $request->contenu;
        $temoignage->client_id = $request->client_id;
        $temoignage->update();
        return response()->json($temoignage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temoignage $temoignage,$id)
    {
         // Trouver la catégorie par ID
    $temoignage = temoignage::find($id);

    // Vérifier si la catégorie existe
    if (!$temoignage) {
        return response()->json(['message' => 'temoignage not found'], 404);
    }

    // Supprimer la catégorie
    $temoignage->delete();

    // Retourner une réponse de succès
    return response()->json(['message' => 'temoignage deleted successfully']);
    }
}
