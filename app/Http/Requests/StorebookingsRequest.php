<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
class StorebookingsRequest extends FormRequest
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
            'event_hall_id'    => 'required|integer|exists:event_halls,id',
            'full_name'        => 'required|string|max:255',           
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'address'          => 'nullable|string|max:500',
            'city'             => 'nullable|string|max:255',
            'region'           => 'nullable|string|max:255',
            'country'          => 'nullable|string|max:255',
            'arrival_time'     => 'required|date|after:now',
            'departure_time'   => 'required|date|after:arrival_time',
            'message'          => 'nullable|string|max:500',
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
            'event_hall_id.required'   => 'La salle de fête est requise.',
            'event_hall_id.exists'     => 'La salle de fête sélectionnée est invalide.',
            'full_name.required'       => 'Votre nom complet est requis.',
            'email.required'           => 'Votre adresse email est requise.',
            'email.email'              => 'Veuillez fournir une adresse email valide.',
            'phone.required'           => 'Votre numéro de téléphone est requis.',
            'arrival_time.required'    => 'La date d\'arrivée est requise.',
            'arrival_time.date'        => 'La date d\'arrivée doit être une date valide.',
            'arrival_time.after'       => 'La date d\'arrivée doit être ultérieure à aujourd\'hui.',
            'departure_time.required'  => 'La date de départ est requise.',
            'departure_time.date'      => 'La date de départ doit être une date valide.',
            'departure_time.after'     => 'La date de départ doit être ultérieure à la date d\'arrivée.',
        ];
    }
}
