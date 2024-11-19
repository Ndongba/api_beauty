<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Proprestation;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
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
// public function getClientReservations(): JsonResponse
// {
//     $clientId = Auth::id(); // Récupérer l'ID du client connecté
//     $reservations = Reservation::where('client_id', $clientId)
//         ->with(['client', 'proprestation'])
//         ->get(); // Inclut les relations

//     return response()->json($reservations);
// }

/**
 * Affiche les reservations d'un professionnel specifique
 */

 public function getReservationsByProfessionnel(): JsonResponse
{
    // Récupérer l'ID de l'utilisateur connecté
    $userId = Auth::id();

    // Trouver le professionnel lié à cet utilisateur
    $professionnel = User::find($userId)->professionnel;

    // S'assurer que l'utilisateur connecté est bien un professionnel
    if (!$professionnel) {
        return response()->json(['message' => 'Professionnel non trouvé'], 404);
    }

    // Récupérer les réservations liées au professionnel via les prestations
    $reservations = $professionnel->proprestation()
        ->with([
            'reservations' => function ($query) {
                // Sélectionner uniquement les champs nécessaires dans la table `reservations`
                $query->select('id', 'proprestation_id', 'date_prévue', 'heure_prévue', 'montant', 'status', 'client_id');
            },
            'reservations.client.user:id,name,email',
            'prestation:id,libelle' // Charger le libelle de la prestation
        ])
        ->get()
        ->pluck('reservations')
        ->flatten() // Aplatit les résultats pour éviter une structure imbriquée
        ->map(function ($reservation) {
            // Structurer les données en ne gardant que les champs requis
            return [
                'date_prévue' => $reservation->date_prévue,
                'heure_prévue' => $reservation->heure_prévue,
                'montant' => $reservation->montant,
                'status' => $reservation->status,
                'client_nom' => $reservation->client->user->name ?? null,
                'client_email' => $reservation->client->user->email ?? null,
                'client_phone' => $reservation->client->telephone ?? null,
                'client_adresse' => $reservation->client->adresse ?? null,
                'prestation_libelle' => $reservation->proprestation->prestation->libelle ?? null,
            ];
        });

    return response()->json($reservations);
}

/**
 * Affiche la liste des clients par Professionnel
 */

public function getClientsPros(): JsonResponse
{
    $professionnelId = Auth::id();

    $clients = DB::table('users')
        ->join('reservations', 'users.id', '=', 'reservations.client_id')
        ->join('proprestations', 'reservations.proprestation_id', '=', 'proprestations.id')
        ->where('proprestations.professionnel_id', $professionnelId)
        ->select('users.*')  // Sélectionne les colonnes de la table users
        ->distinct()         // Évite les doublons de clients
        ->get();

    return response()->json($clients);
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
     * Annulée une réservation.
     */
    public function destroy(Reservation $reservation): JsonResponse
    {
        // Vérifier si la réservation est déjà annulée
        if ($reservation->status === 'annulé') {
            return response()->json(['message' => 'Cette réservation est déjà annulée.'], 400);
        }

        // Mettre à jour le statut de la réservation à "annulé"
        $reservation->status = "annulé"; // Utilisez des guillemets doubles ici
        $reservation->save();

        return response()->json(['message' => 'Réservation annulée avec succès']);
    }



}

