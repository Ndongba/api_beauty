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
     * Store a newly created resource in storage.
     */
    public function store(StoreTemoignageRequest $request)
    {
        // Créer un témoignage avec les données validées
        $temoignage = Temoignage::create($request->validated());

        return response()->json($temoignage, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Temoignage $temoignage)
    {
        return response()->json($temoignage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemoignageRequest $request, Temoignage $temoignage)
    {
        // Mettre à jour l'instance de témoignage existante avec les données validées
        $temoignage->update($request->validated());

        return response()->json($temoignage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();

        return response()->json(['message' => 'Temoignage deleted successfully']);
    }
}
