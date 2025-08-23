@extends('layouts.admin.layout-admin')
@section('title', 'Enregistrer un paiement')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 dark:text-white mb-6">
        Enregistrer un paiement
    </h1>

    <form {{-- action="{{ route('admin.paiements.store') }}" --}} method="POST" class="space-y-4">
        @csrf

        {{-- Client --}}
        <div>
            <label for="client_id" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Client</label>
            <select name="client_id" id="client_id"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Montant --}}
        <div>
            <label for="montant" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Montant</label>
            <input type="number" step="0.01" name="montant" id="montant" value="{{ old('montant') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('montant') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Date de paiement --}}
        <div>
            <label for="date_paiement" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Date de
                paiement</label>
            <input type="date" name="date_paiement" id="date_paiement" value="{{ old('date_paiement') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('date_paiement') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- type de paiement --}}
        <div>
            <label for="type_paiement" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Mode de
                paiement</label>
            <select name="type_paiement" id="type_paiement"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="">-- Sélectionner un mode de paiement --</option>
                <option value="cash">Depot</option>
                <option value="carte">Espece</option>
            </select>
            @error('type_paiement') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection