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
            'mesures' => 'nullable|array',
            'mesures.poitrine' => 'nullable|numeric',
            'mesures.taille' => 'nullable|numeric',
            'prix_total' => 'required|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'date_livraison' => 'required|date|after_or_equal:today',
            'statut' => 'required|in:En_cours,Terminé,Livré',
            'image_tissu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'client_id.required' => 'Le client est obligatoire.',
            'client_id.exists' => 'Le client sélectionné est invalide.',
            'type_habit.required' => 'Le type d’habit est obligatoire.',
            'prix_total.required' => 'Le prix total est obligatoire.',
            'date_livraison.required' => 'La date de livraison est obligatoire.',
            'statut.required' => 'Le statut est obligatoire.',
            'statut.in' => 'Le statut doit être En_cours, Terminé ou Livré.',
        ];
    }
}
