<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'date_prévue' => 'sometimes|required|date|after_or_equal:today',  // La date doit être valide et au minimum la date du jour
            // 'heure_prévue' => 'sometimes|required|date_format:H:i',            // Valide les heures au format 24h (ex: 14:30)
            // 'montant' => 'required|numeric|min:0',                   // Montant optionnel mais doit être >= 0 s'il est présent
            // 'status' => 'sometimes|required|in:reservé,terminé',                // Seules les valeurs 'reservé' et 'terminé' sont acceptées
            // 'client_id' => 'sometimes|required|integer|exists:clients,id',      // ID du client doit exister dans la table clients
            // 'proprestation_id' => 'sometimes|required|integer|exists:proprestations,id' // ID de la prestation doit exister dans la table proprestations
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // 'date_prévue.required' => 'La date prévue est obligatoire.',
            // 'date_prévue.date' => 'La date prévue doit être une date valide.',
            // 'date_prévue.after_or_equal' => 'La date prévue doit être aujourd\'hui ou une date future.',

            // 'heure_prévue.required' => 'L\'heure prévue est obligatoire.',
            // 'heure_prévue.date_format' => 'L\'heure prévue doit être au format HH:MM.',

            // 'montant.numeric' => 'Le montant doit être un nombre.',
            // 'montant.min' => 'Le montant doit être supérieur ou égal à 0.',

            // 'status.required' => 'Le statut est obligatoire.',
            // 'status.in' => 'Le statut doit être soit "reservé", soit "terminé".',

            // 'client_id.required' => 'Le client est obligatoire.',
            // 'client_id.integer' => 'Le client doit être un entier.',
            // 'client_id.exists' => 'Le client sélectionné n\'existe pas.',

            // 'proprestation_id.required' => 'La prestation est obligatoire.',
            // 'proprestation_id.integer' => 'La prestation doit être un entier.',
            // 'proprestation_id.exists' => 'La prestation sélectionnée n\'existe pas.',
        ];
    }
}
