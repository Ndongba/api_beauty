<?php

namespace App\Http\Controllers;

use App\Mail\MailBeaute;
use App\Models\User;
use App\Models\Reservation; // Importez le modèle Reservation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailBeauteController extends Controller
{
    public function index(Request $request, $id)
    {
        // Récupérer l'utilisateur
        $user = User::find($id);

        // Vérifier que l'utilisateur existe
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
        }

        // Récupérer la réservation
        $reservation = Reservation::find($request->input('reservation_id'));

        // Vérifier que la réservation existe
        if (!$reservation) {
            return response()->json(['message' => 'Réservation non trouvée.'], 404);
        }

        // Préparer les données pour l'email
        $mailData = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'details' => $reservation->details,
        ];

        // Envoyer l'email
        Mail::to($user->email)->send(new MailBeaute($user, $mailData, $reservation));

        return response()->json(['message' => 'Email envoyé avec succès.']);
    }


}
