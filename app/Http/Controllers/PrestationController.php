<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestationRequest;
use App\Http\Requests\UpdatePrestationRequest;
use App\Models\Prestation;
use App\Models\Professionnel;

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
        // // Créer une nouvelle prestation avec les données validées
        // $prestation = Prestation::create($request->validated());

        // return response()->json($prestation, 201);



    // Validation des données
    // $request->validate([
    //     'libelle' => 'required|string|max:255',
    //     'description' => 'required|string', // Correction ici
    //     'type_prestation' => 'required|string|max:255',
    //     'type_prix' => 'required|numeric|min:0',
    //     'categorie_id' => 'required|exists:categories,id',
    //     'duree' => 'required|date_format:H:i',
    //     'prix' => 'required|numeric|min:0',
    // ]);


    // Création de la prestation
    $prestation = Prestation::create($request->all());

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

    public function listePrestationParProf($professionelId)
    {
        // Vérifier si le professionnel existe
        $professionnel = Professionnel::find($professionelId);

        if (!$professionnel) {
            return response()->json([
                'message' => 'Professionnel non trouvé.',
                'status' => 404
            ]);
        }

        // Récupérer la liste des prestations associées au professionnel via la table pivot
        $prestations = $professionnel->prestations()->get(); // Utilisez 'prestations' au lieu de 'prestation'

        // Vérifier si des prestations sont trouvées
        if ($prestations->isEmpty()) {
            return response()->json([
                'message' => 'Aucune prestation associée à ce professionnel.',
                'status' => 404
            ]);
        }

        return response()->json([
            'message' => 'Liste des prestations pour le professionnel',
            'données' => $prestations,
            'status' => 200
        ]);
    }

}
