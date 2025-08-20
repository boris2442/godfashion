<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'type_habit' => 'required|string|max:255',
            'tissu' => 'nullable|string',
            'mesures' => 'nullable|string',

            'prix_total' => 'required|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'date_livraison' => 'required|date|after_or_equal:today',
            'statut' => 'required|in:En_cours,Terminé,Livré',
            'image_tissu' => 'nullable|array|max:5', // max 5 images
            'image_tissu.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // chaque image
        ];
    }
    public function messages()
    {
        return [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné n’existe pas.',

            'type_habit.required' => 'Le type de vêtement est obligatoire.',
            'type_habit.string' => 'Le type de vêtement doit être une chaîne de caractères.',
            'type_habit.max' => 'Le type de vêtement ne peut pas dépasser 255 caractères.',

            'tissu.string' => 'La description du tissu doit être une chaîne de caractères.',

            'mesures.string' => 'Les mesures doivent être une chaîne de caractères (ex: JSON).',

            'prix_total.required' => 'Le prix total est obligatoire.',
            'prix_total.numeric' => 'Le prix total doit être un nombre.',
            'prix_total.min' => 'Le prix total doit être supérieur ou égal à 0.',

            'avance.numeric' => 'L’avance doit être un nombre.',
            'avance.min' => 'L’avance doit être supérieure ou égale à 0.',

            'date_livraison.required' => 'La date de livraison est obligatoire.',
            'date_livraison.date' => 'La date de livraison doit être une date valide.',
            'date_livraison.after_or_equal' => 'La date de livraison doit être aujourd’hui ou une date future.',

            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être "En_cours", "Terminé" ou "Livré".',
            'image_tissu.array' => 'Les images du tissu doivent être un tableau.',
            'image_tissu.max' => 'Vous ne pouvez pas télécharger plus de 5 images.',
            'image_tissu.*.image' => 'Chaque image du tissu doit être une image valide.',
            'image_tissu.*.mimes' => 'Les images du tissu doivent être au format jpeg, png, jpg ou gif.',
            'image_tissu.*.max' => 'Chaque image du tissu ne peut pas dépasser 2 Mo.',
            

           
        ];
    }
}
