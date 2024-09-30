<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProprestationRequest;
use App\Http\Requests\UpdateProprestationRequest;
use App\Models\Proprestation;

class ProprestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Proprestation::all());
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
    public function store(StoreProprestationRequest $request)
    {
         // Créer une nouvelle commande avec les données validées
         $proprestation = Proprestation::create($request->validated());

         return response()->json($proprestation, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proprestation $proprestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proprestation $proprestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProprestationRequest $request, Proprestation $proprestation)
    {


          

            $proprestation->update($request->validated());

            return response()->json($proprestation);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proprestation $proprestation)
    {
        $proprestation->delete();
        return response()->json(['message' => 'Proprestation deleted successfully']);
    }

}
