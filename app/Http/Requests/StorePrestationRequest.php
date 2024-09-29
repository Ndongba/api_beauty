<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrestationRequest extends FormRequest
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
            'libelle' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'prix' => 'required|numeric|min:0',
            'duree' => 'required|date_format:H:i:s',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }
}
