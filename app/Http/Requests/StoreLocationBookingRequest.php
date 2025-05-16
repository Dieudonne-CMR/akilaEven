<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class StoreLocationBookingRequest extends FormRequest
{
    /**
     * Prépare les données avant validation.
     */
    protected function prepareForValidation(): void
    {
        foreach (['arrival_time', 'departure_time'] as $field) {
            if ($this->filled($field)) {
                // Récupère la chaîne brute
                $raw = $this->input($field);

                // Supprime la partie entre parenthèses, p. ex. " (Central European Summer Time)"
                $clean = preg_replace('/\s\(.*\)$/', '', $raw);

                try {
                    // Carbon::parse() gère "Mon Apr 28 2025 00:00:00 GMT+0200"
                    $dt = Carbon::parse($clean);
                    // On injecte au format ISO standard
                    $this->merge([
                        $field => $dt->toDateTimeString(),
                    ]);
                } catch (\Exception $e) {
                    // En cas d'échec, on laisse la validation renvoyer une erreur 'date'
                }
            }
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Tout le monde peut faire une demande de réservation
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
            'location_id'      => 'required|integer|exists:locations,id',
            'full_name'        => 'required|string|max:255',           
            'email'            => 'required|email|max:255',
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:500',
            'city'             => 'nullable|string|max:100',
            'arrival_time'     => 'nullable|date',
            'departure_time'   => 'nullable|date|after_or_equal:arrival_time',
            'message'          => 'nullable|string|max:1000',
        ];
    }

    /**
     * Messages personnalisés pour les erreurs de validation.
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'location_id.required'     => 'La location est requise.',
            'location_id.exists'       => 'La location sélectionnée est invalide.',
            'full_name.required'       => 'Votre nom complet est requis.',
            'email.required'           => 'Votre adresse email est requise.',
            'email.email'              => 'Veuillez fournir une adresse email valide.',
            'arrival_time.date'        => 'La date d\'arrivée doit être une date valide.',
            'departure_time.date'      => 'La date de départ doit être une date valide.',
            'departure_time.after_or_equal' => 'La date de départ doit être ultérieure ou égale à la date d\'arrivée.',
        ];
    }
} 