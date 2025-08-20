@extends('layouts.admin.layout-admin')
@section('title', 'Modifier une commande')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 dark:text-white mb-6">
        Modifier la commande #{{ $commande->id }}
    </h1>

    <form action="{{ route('admin.commandes.update', $commande->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Client --}}
        <div>
            <label for="client_id" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Client</label>
            <select name="client_id" id="client_id"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ $commande->client_id == $client->id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
                @endforeach
            </select>
            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Type d'habit --}}
        <div>
            <label for="type_habit" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Type
                d'habit</label>
            <input type="text" name="type_habit" id="type_habit" value="{{ old('type_habit', $commande->type_habit) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('type_habit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Tissu --}}
        <div>
            <label for="tissu" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Description du
                tissu</label>
            <textarea name="tissu" id="tissu"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">{{ old('tissu', $commande->tissu) }}</textarea>
            @error('tissu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Mesures --}}
        <div>
            <label for="mesures" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Mesures
              </label>
            <input type="text" name="mesures" id="mesures" placeholder='{"poitrine":95,"taille":80}'
                value="{{ old('mesures', $commande->mesures) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('mesures') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Prix total --}}
        <div>
            <label for="prix_total" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Prix total</label>
            <input type="number" step="0.01" name="prix_total" id="prix_total"
                value="{{ old('prix_total', $commande->prix_total) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('prix_total') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Avance --}}
        <div>
            <label for="avance" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Avance</label>
            <input type="number" name="avance" id="avance" value="{{ old('avance', $commande->avance) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('avance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Date de livraison --}}
        <div>
            <label for="date_livraison" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Date de
                livraison</label>
            <input type="date" name="date_livraison" id="date_livraison"
                value="{{ old('date_livraison', $commande->date_livraison?->format('Y-m-d')) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('date_livraison') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Statut --}}
        <div>
            <label for="statut" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Statut</label>
            <select name="statut" id="statut"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="En_cours" {{ $commande->statut == 'En_cours' ? 'selected' : '' }}>En cours</option>
                <option value="Terminé" {{ $commande->statut == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                <option value="Livré" {{ $commande->statut == 'Livré' ? 'selected' : '' }}>Livré</option>
            </select>
            @error('statut') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>






        {{-- Bouton --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-blue-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200">
                Mettre à jour la commande
            </button>
        </div>
    </form>
</div>
@endsection