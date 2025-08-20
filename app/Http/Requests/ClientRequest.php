<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'         => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'string', 'max:30'],
            'adresse'     => ['nullable', 'string', 'max:500'],
           
     
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du client est obligatoire.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
         
            'adresse.max' => 'L\'adresse ne peut pas dépasser 500 caractères.',
         
        ];
    }
}
