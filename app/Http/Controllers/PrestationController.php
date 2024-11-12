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
        return response()->json([
            'message' => 'Liste des prestations',
            'data' => Prestation::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrestationRequest $request)
    {
        try {
            $prestation = Prestation::create($request->only(['libelle', 'type_prestation', 'description','categorie_id','duree','type_prix','prix']));

            return response()->json([
                'message' => 'Prestation créée avec succès',
                'data' => $prestation
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la création de la prestation',
                'error' => $e->getMessage()
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        return response()->json([
            'message' => 'Détails de la prestation',
            'data' => $prestation
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrestationRequest $request, Prestation $prestation)
    {
        $prestation->update($request->validated());

        return response()->json([
            'message' => 'Prestation mise à jour avec succès',
            'data' => $prestation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
        $prestation->delete();

        return response()->json([
            'message' => 'Prestation supprimée avec succès',
            'data' => null
        ]);
    }

    /**
     * Liste des prestations pour un professionnel donné.
     */
    public function listePrestationParProf($professionelId)
    {
        $professionnel = Professionnel::find($professionelId);

        if (!$professionnel) {
            return response()->json([
                'message' => 'Professionnel non trouvé',
                'data' => null,
                'status' => 404
            ]);
        }

        $prestations = $professionnel->prestations()->get();

        if ($prestations->isEmpty()) {
            return response()->json([
                'message' => 'Aucune prestation associée à ce professionnel',
                'data' => [],
                'status' => 404
            ]);
        }

        return response()->json([
            'message' => 'Liste des prestations pour le professionnel',
            'data' => $prestations,
            'status' => 200
        ]);
    }

    /**
     * Validate prestation data.
     */
    private function validatePrestationData(array $prestationData)
    {
        return validator($prestationData, [
            'libelle' => 'required|string|max:255',
            'description' => 'required|string',
            'type_prestation' => 'required|string|max:255',
            'type_prix' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'duree' => 'required|date_format:H:i',
            'prix' => 'required|numeric|min:0',
        ])->validate();
    }
}
