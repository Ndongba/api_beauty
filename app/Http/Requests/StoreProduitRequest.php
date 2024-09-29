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
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
            'image' => 'nullable|string|max:255', // Ou utilisez 'file|image' si c'est une image
            'prix' => 'sometimes|required|numeric|min:0',
            'professionnel_id' => 'sometimes|required|exists:professionnels,id',
            'categorie_id' => 'sometimes|required|exists:categories,id',
         ];
    }
}
