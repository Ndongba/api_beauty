<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Commande::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandeRequest $request)
    {
        // Créer une nouvelle commande avec les données validées
        $commande = Commande::create($request->validated());

        return response()->json($commande, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        return response()->json($commande);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        // Mettre à jour la commande avec les nouvelles données validées
        $commande->update($request->validated());

        return response()->json($commande);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();

        return response()->json(['message' => 'Commande deleted successfully']);
    }
}
