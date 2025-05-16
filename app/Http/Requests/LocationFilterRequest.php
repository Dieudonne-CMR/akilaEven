<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationFilterRequest extends FormRequest
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
            'search' => 'nullable|string|max:100',
            'sort_by' => 'nullable|string|in:price_asc,price_desc',
            'min_prix' => 'nullable|numeric|min:0',
            'max_prix' => 'nullable|numeric|gte:min_prix',
            'locations' => 'nullable|string|regex:/^[a-zA-ZéèêëàâäôöûüçÉÈÊËÀÂÄÔÖÛÜÇ\s,]+$/',
            'type_location' => 'nullable|string',
            'type_logement' => 'nullable|string',
        ];
    }
} 