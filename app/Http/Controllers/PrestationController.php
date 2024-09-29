<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestationRequest;
use App\Http\Requests\UpdatePrestationRequest;
use App\Models\Prestation;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Prestation::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestationRequest $request)
    {
        // Créer une nouvelle prestation avec les données validées
        $prestation = Prestation::create($request->validated());

        return response()->json($prestation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        return response()->json($prestation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestationRequest $request, Prestation $prestation)
    {
        // Mettre à jour la prestation avec les données validées
        $prestation->update($request->validated());

        return response()->json($prestation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
        $prestation->delete();

        return response()->json(['message' => 'Prestation deleted successfully']);
    }
}
