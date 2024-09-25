<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        //     'nom' => 'required|string|max:255',
        //     'description' => 'required|string|max:1500', // Utilisez 'string' pour le texte long
        //     'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        //     'prix' => 'required|numeric|min:0|max:999999.99', // Utilisez 'numeric' pour les prix
        //     'professionnel_id' => 'required|integer|exists:professionnels,id', // Optionnel: vérifier si l'ID existe
        //     'categorie_id' => 'required|integer|exists:categories,id' // Optionnel: vérifier si l'ID existe
         ];
    }
}
