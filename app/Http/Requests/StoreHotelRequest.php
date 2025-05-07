<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreHotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autoriser la requête
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_hotel' => 'required|string|max:255',
            'description_hotel' => 'required|string',
            'ville' => 'required|exists:villes,id',
            'localisation' => 'required|string|max:255',
            'telephone' => 'required|string|regex:/^6[0-9]{8}$/',
            'email' => 'required|email|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'bannier1' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'bannier2' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'bannier3' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'services' => 'nullable|array',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nom_hotel.required' => 'Le nom de l\'hôtel est obligatoire.',
            'description_hotel.required' => 'La description de l\'hôtel est obligatoire.',
            'ville.required' => 'Veuillez sélectionner une ville.',
            'ville.exists' => 'La ville sélectionnée n\'existe pas.',
            'localisation.required' => 'L\'adresse de l\'hôtel est obligatoire.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.regex' => 'Le numéro de téléphone doit commencer par 6 et contenir 9 chiffres.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'logo.required' => 'Le logo de l\'hôtel est obligatoire.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.mimes' => 'Le logo doit être au format jpeg, jpg ou png.',
            'logo.max' => 'La taille du logo ne doit pas dépasser 4 Mo.',
            'bannier1.image' => 'La bannière doit être une image.',
            'bannier1.mimes' => 'La bannière doit être au format jpeg, jpg ou png.',
            'bannier1.max' => 'La taille de la bannière ne doit pas dépasser 4 Mo.',
            'bannier2.image' => 'La bannière doit être une image.',
            'bannier2.mimes' => 'La bannière doit être au format jpeg, jpg ou png.',
            'bannier2.max' => 'La taille de la bannière ne doit pas dépasser 4 Mo.',
            'bannier3.image' => 'La bannière doit être une image.',
            'bannier3.mimes' => 'La bannière doit être au format jpeg, jpg ou png.',
            'bannier3.max' => 'La taille de la bannière ne doit pas dépasser 4 Mo.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Vérifier qu'au moins une bannière est uploadée
            if (!$this->hasFile('bannier1') && !$this->hasFile('bannier2') && !$this->hasFile('bannier3')) {
                $validator->errors()->add('bannieres', 'Au moins une bannière est requise.');
            }
        });
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
     protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($errors)
                ->withInput()
                ->with('toast', [
                    'type' => 'error',
                    'message' => 'Veuillez corriger les erreurs dans le formulaire.'
                ])
        );
    }
}
