<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommandeRequest extends FormRequest
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
            'quantite' => 'sometimes|required|integer|min:1',
            'prix_total' => 'sometimes|required|numeric|min:0',
            'client_id' => 'sometimes|required|exists:clients,id',
            'produit_id' => 'sometimes|required|exists:produits,id',
        ];
    }
}
