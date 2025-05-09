<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
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
            'nom_location' => 'required|string|max:255',
            'description_location' => 'required|string|max:1000',
            'localisation' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'area' => 'required|numeric|min:1',
            'type_location' => 'required|string|in:' . implode(',', \App\Models\Location::TYPE_LOCATION),
            'type_logement' => 'required|string|in:' . implode(',', \App\Models\Location::TYPE_LOGEMENT),
            'prix' => 'required|numeric|min:1',
            'equipments' => 'nullable|array|max:10',
            'equipments.*' => 'string|max:50',
            'rules' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:4096',
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
            'nom_location.required' => 'Le nom de la location est obligatoire.',
            'nom_location.max' => 'Le nom de la location ne doit pas dépasser 255 caractères.',
            'description_location.required' => 'La description de la location est obligatoire.',
            'description_location.max' => 'La description ne doit pas dépasser 1000 caractères.',
            'localisation.required' => 'L\'emplacement précis de la location est obligatoire.',
            'ville_id.required' => 'Veuillez sélectionner une ville.',
            'ville_id.exists' => 'La ville sélectionnée n\'est pas valide.',
            'area.required' => 'La surface de la location est obligatoire.',
            'area.numeric' => 'La surface doit être un nombre.',
            'area.min' => 'La surface doit être supérieure à 0.',
            'type_location.required' => 'Le type de location est obligatoire.',
            'type_location.in' => 'Le type de location sélectionné n\'est pas valide.',
            'type_logement.required' => 'Le type de logement est obligatoire.',
            'type_logement.in' => 'Le type de logement sélectionné n\'est pas valide.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix doit être supérieur à 0.',
            'equipments.max' => 'Vous ne pouvez pas ajouter plus de 10 équipements.',
            'equipments.*.max' => 'Chaque équipement ne doit pas dépasser 50 caractères.',
            'photo.required' => 'L\'image principale est obligatoire.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format jpeg, jpg ou png.',
            'photo.max' => 'L\'image ne doit pas dépasser 4 Mo.',
            'additional_images.max' => 'Vous ne pouvez pas ajouter plus de 4 images additionnelles.',
            'additional_images.*.image' => 'Les fichiers supplémentaires doivent être des images.',
            'additional_images.*.mimes' => 'Les images doivent être au format jpeg, jpg ou png.',
            'additional_images.*.max' => 'Chaque image ne doit pas dépasser 4 Mo.',
        ];
    }
}
