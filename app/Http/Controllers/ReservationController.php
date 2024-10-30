<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Proprestation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Affiche la liste des réservations.
     */
    public function index(): JsonResponse
{
    $clientId = Auth::id(); // Récupérer l'ID du client connecté

    $reservations = Reservation::where('client_id', $clientId)
        ->with(['client', 'proprestation.prestation', 'proprestation.professionnel.user']) // Utilisez les relations correctement définies
        ->get();

    return response()->json($reservations);
}



    /**
     * Enregistre une nouvelle réservation.
     */
    public function store(Request $request): JsonResponse
    {
        $client= Auth::user()->id;
        // Validation des données entrantes
         $validated = $request->validate(
            [
             //'client_id' => 'required|exists:clients,id',
             'proprestation_id' => 'required|exists:proprestations,id',
             'date_prévue' => 'required|date',
             'heure_prévue' => 'required',
             'montant' => 'required|numeric',
             'status' => 'nullable|string',
         ]);


        // Crée une nouvelle réservation
        $reservation = Reservation::create([
            'client_id'=> $client,
            'proprestation_id' =>$request->proprestation_id,
            'date_prévue' => $request->date_prévue,
            'heure_prévue' => $request->heure_prévue,
            'montant' => $request->montant,
            'status' => 'Reservé'
        ]);

        return response()->json($reservation, 201);
    }

    /**
 * Affiche les réservations d'un client spécifique.
 */
public function getClientReservations(): JsonResponse
{
    $clientId = Auth::id(); // Récupérer l'ID du client connecté
    $reservations = Reservation::where('client_id', $clientId)
        ->with(['client', 'proprestation'])
        ->get(); // Inclut les relations

    return response()->json($reservations);
}

    /**
     * Affiche une réservation spécifique.
     */
    public function show(Reservation $reservation): JsonResponse
    {
        return response()->json($reservation->load(['client', 'proprestation'])); // Inclut les relations
    }

    /**
     * Met à jour une réservation existante.
     */
    public function update(Request $request, $id): JsonResponse
    {
        // Validation des données entrantes
        try {
            $validated = $request->validate([
                'client_id' => 'sometimes|exists:clients,id',
                'proprestation_id' => 'sometimes|exists:proprestations,id',
                'date_prévue' => 'sometimes|date',
                'heure_prévue' => 'sometimes',
                'montant' => 'sometimes|numeric',
                'status' => 'nullable|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Trouver la réservation par son ID
        $reservation = Reservation::find($id);

        // Vérifiez si la réservation existe
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée'], 404);
        }

        // Mise à jour de la réservation
        $reservation->update($validated);

        return response()->json($reservation);
    }


    /**
     * Supprime une réservation.
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        $reservation->delete();

        return response()->json(['message' => 'Réservation supprimée avec succès']);
    }
}

