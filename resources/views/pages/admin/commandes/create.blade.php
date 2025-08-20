@extends('layouts.admin.layout-admin')
@section('title', 'Ajouter une commande')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 dark:text-white mb-6">
        Ajouter une commande
    </h1>

    <form action="{{ route('admin.commandes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Client --}}
        <div>
            <label for="client_id" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Client</label>
            <select name="client_id" id="client_id"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}" class="text-gray-500">{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Type d'habit --}}
        <div>
            <label for="type_habit" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Type
                d'habit</label>
            <input type="text" name="type_habit" id="type_habit" value="{{ old('type_habit') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('type_habit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Tissu --}}
        <div>
            <label for="tissu" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Description du
                tissu</label>
            <textarea name="tissu" id="tissu"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">{{ old('tissu') }}</textarea>
            @error('tissu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Mesures --}}
        <div>
            <label for="mesures" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Mesures
                (JSON)</label>
            <input type="text" name="mesures" id="mesures" placeholder='{"poitrine":95,"taille":80}'
                value="{{ old('mesures') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('mesures') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Prix total --}}
        <div>
            <label for="prix_total" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Prix total</label>
            <input type="number" step="0.01" name="prix_total" id="prix_total" value="{{ old('prix_total') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('prix_total') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Avance --}}
        <div>
            <label for="avance" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Avance</label>
            <input type="number" name="avance" id="avance" value="{{ old('avance', 0) }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('avance') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Date de livraison --}}
        <div>
            <label for="date_livraison" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Date de
                livraison</label>
            <input type="date" name="date_livraison" id="date_livraison" value="{{ old('date_livraison') }}"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
            @error('date_livraison') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Statut --}}
        <div>
            <label for="statut" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Statut</label>
            <select name="statut" id="statut"
                class="w-full border border-gray-300 dark:border-gray-700 rounded px-3 py-2 text-gray-900 dark:text-gray-200 bg-white dark:bg-gray-700">
                <option value="En_cours">En cours</option>
                <option value="Terminé">Terminé</option>
                <option value="Livré">Livré</option>
            </select>
            @error('statut') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Image du tissu --}}
        <div>
            <label for="image_tissu" class="block text-gray-700 dark:text-gray-200 font-semibold mb-1">Image du
                tissu</label>
            <input type="file" name="image_tissu[]" id="image_tissu" class="w-full text-gray-900 dark:text-gray-200"
                multiple accept="image/*">
            @error('image_tissu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div id="preview" class="flex overflow-x-auto gap-2 mt-4">
            <!-- Les images prévisualisées apparaîtront ici -->
        </div>
        {{-- Bouton --}}
        <div class="pt-4">
            <button type="submit"
                class="bg-blue-900 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200">
                Ajouter la commande
            </button>
        </div>

    </form>
</div>
<script>
    document.getElementById('image_tissu').addEventListener('change', function(e) {
    const preview = document.getElementById('preview');
    preview.innerHTML = ''; // Vider l'ancien contenu

    const files = e.target.files;

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    });
});
</script>
@endsection