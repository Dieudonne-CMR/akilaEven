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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'location' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'capacity' => 'required|integer|min:1',
            'area' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
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
            'name.required' => 'Le nom de la salle est obligatoire.',
            'name.max' => 'Le nom de la salle ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description de la salle est obligatoire.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
            'location.required' => 'L\'emplacement précis de la salle est obligatoire.',
            'ville_id.required' => 'Veuillez sélectionner une ville.',
            'ville_id.exists' => 'La ville sélectionnée n\'est pas valide.',
            'capacity.required' => 'La capacité de la salle est obligatoire.',
            'capacity.integer' => 'La capacité doit être un nombre entier.',
            'capacity.min' => 'La capacité doit être supérieure à 0.',
            'area.required' => 'La surface de la salle est obligatoire.',
            'area.numeric' => 'La surface doit être un nombre.',
            'area.min' => 'La surface doit être supérieure à 0.',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix doit être supérieur à 0.',
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
