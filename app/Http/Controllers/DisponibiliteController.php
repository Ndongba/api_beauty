<?php

namespace App\Http\Controllers;

use App\Models\Disponibilite;
use Illuminate\Http\Request;

class DisponibiliteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Disponibilite::all());
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
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'jour' => 'required',
    //         'heure_ouverture' => 'required',
    //         'heure_fermeture' => 'required',
    //         'professionnel_id' => 'required'

    //     ]);

    //     $disponibilite = Disponibilite::create([
    //         'jour' => $request-> jour,
    //         'heure_ouverture' => $request-> heure_ouverture,
    //         'heure_fermeture' => $request-> heure_fermeture,
    //         'professionnel_id' => $request-> professionnel_id

    //     ]);

    //     return response()->json($disponibilite,201);
    // }

    public function store(Request $request)
{
    // Valider les données
    $validated = $request->validate([
        'jour' => 'required|string',
        'heure_ouverture' => 'required',
        'heure_fermeture' => 'required',
        'professionnel_id' => 'required|exists:professionnels,id'  // Assurez-vous que l'id du professionnel existe
    ]);

    try {
        // Créer la disponibilité
        $disponibilite = Disponibilite::create($validated);

        // Retourner une réponse JSON avec la ressource créée et un code 201
        return response()->json([
            'message' => 'Disponibilité créée avec succès.',
            'data' => $disponibilite
        ], 201);
    } catch (\Exception $e) {
        // En cas d'erreur, retourner une réponse JSON avec un message d'erreur
        return response()->json([
            'message' => 'Erreur lors de la création de la disponibilité.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function getByProfessionnel($professionnelId)
    {
        try {
            $disponibilites = Disponibilite::where('professionnel_id', $professionnelId)
                ->orderBy('jour')
                ->get();

            return response()->json([
                'status' => 'success',
                'données' => $disponibilites
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la récupération des disponibilités',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disponibilite $disponibilite)
    {
        // Valider les données entrantes
        $validated = $request->validate([
            // 'jour' => 'required|string',
            // 'heure_ouverture' => 'required',
            // 'heure_fermeture' => 'required',
            // 'professionnel_id' => 'required|exists:professionnels,id'
        ]);

        try {
            // Mettre à jour la disponibilité avec les données validées
            $disponibilite->update($validated);

            // Retourner une réponse JSON avec la disponibilité mise à jour
            return response()->json([
                'message' => 'Disponibilité mise à jour avec succès.',
                'data' => $disponibilite
            ], 200);
        } catch (\Exception $e) {
            // En cas d'erreur, retourner une réponse JSON avec un message d'erreur
            return response()->json([
                'message' => 'Erreur lors de la mise à jour de la disponibilité.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Disponibilite $disponibilite)
    {
        $disponibilite->delete();

        return response()->json(['message' => 'Temoignage deleted successfully']);
    }
}
