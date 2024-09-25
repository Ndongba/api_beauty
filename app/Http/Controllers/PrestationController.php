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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestationRequest $request)
    {
        $prestation = new prestation();
            $prestation->libelle = $request->libelle;
            $prestation->description = $request->description;
            $prestation->prix = $request->prix;
            $prestation->duree = $request->duree;
            $prestation->categorie_id = $request->categorie_id;
            $prestation->save();
            return response()->json($prestation);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestationRequest $request, Prestation $prestation)
    {
        $prestation = new prestation();
        $prestation->libelle = $request->libelle;
        $prestation->description = $request->description;
        $prestation->prix = $request->prix;
        $prestation->duree = $request->duree;
        $prestation->categorie_id = $request->categorie_id;
        $prestation->update();
        return response()->json($prestation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
        //
    }
}
