<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventHallRequest extends FormRequest
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
            'nom_salle' => 'required|string|max:255',
            'description_salle' => 'required|string|max:1000',
            'localisation' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'capacite' => 'required|integer|min:1',
            'area' => 'required|numeric|min:1',
            'prix' => 'required|numeric|min:1',
            'amenities' => 'nullable|array|max:10',
            'amenities.*' => 'string|max:50',
            'rules' => 'nullable|string',
            'main_image' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'additional_images' => 'nullable|array|max:4',
            'additional_images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nom_salle.required' => 'Le nom de la salle est obligatoire.',
            'nom_salle.max' => 'Le nom de la salle ne doit pas dépasser 255 caractères.',
            'description_salle.required' => 'La description de la salle est obligatoire.',
            'description_salle.max' => 'La description ne doit pas dépasser 1000 caractères.',
            'localisation.required' => 'L\'emplacement précis de la salle est obligatoire.',
            'ville_id.required' => 'Veuillez sélectionner une ville.',
            'ville_id.exists' => 'La ville sélectionnée n\'est pas valide.',
            'capacite.required' => 'La capacité de la salle est obligatoire.',
            'capacite.integer' => 'La capacité doit être un nombre entier.',
            'capacite.min' => 'La capacité doit être supérieure à 0.',
            'area.required' => 'La surface de la salle est obligatoire.',
            'area.numeric' => 'La surface doit être un nombre.',
            'area.min' => 'La surface doit être supérieure à 0.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être supérieur à 0.',
            'amenities.max' => 'Vous ne pouvez pas ajouter plus de 10 équipements.',
            'amenities.*.max' => 'Chaque équipement ne doit pas dépasser 50 caractères.',
            'main_image.required' => 'L\'image principale est obligatoire.',
            'main_image.image' => 'Le fichier doit être une image.',
            'main_image.mimes' => 'L\'image doit être au format jpeg, jpg ou png.',
            'main_image.max' => 'L\'image ne doit pas dépasser 4 Mo.',
            'additional_images.max' => 'Vous ne pouvez pas ajouter plus de 4 images additionnelles.',
            'additional_images.*.image' => 'Les fichiers supplémentaires doivent être des images.',
            'additional_images.*.mimes' => 'Les images doivent être au format jpeg, jpg ou png.',
            'additional_images.*.max' => 'Chaque image ne doit pas dépasser 4 Mo.',
        ];
    }
}
