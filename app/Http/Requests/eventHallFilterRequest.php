<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class eventHallFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autorise tous les utilisateurs à faire cette requête
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
            //
            'min_prix' => 'nullable|numeric|min:0',
            'max_prix' => 'nullable|numeric|gte:min_prix',
            'min_capacite' => 'nullable|integer|min:0',
            'max_capacite' => 'nullable|integer|gte:min_capacite',
            'locations' => 'nullable|string|regex:/^[a-zA-ZéèêëàâäôöûüçÉÈÊËÀÂÄÔÖÛÜÇ\s,]+$/',
        ];
    }
}
