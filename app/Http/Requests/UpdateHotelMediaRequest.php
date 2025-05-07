<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateHotelMediaRequest extends FormRequest
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
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'bannier1' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'bannier2' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'bannier3' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
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