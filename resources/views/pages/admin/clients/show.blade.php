{{-- resources/views/clients/show.blade.php --}}
@extends('layouts.admin.layout-admin')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-md p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Détails du Client</h2>

    <div class="space-y-4">
        <div>
            <p class="text-sm font-medium text-gray-500">Nom</p>
            <p class="text-lg text-gray-800">{{ $client->name }}</p>
        </div>

        <div>
            <p class="text-sm font-medium text-gray-500">Téléphone</p>
            <p class="text-lg text-gray-800">{{ $client->phone }}</p>
        </div>

        <div>
            <p class="text-sm font-medium text-gray-500">Adresse</p>
            <p class="text-lg text-gray-800">{{ $client->adresse }}</p>
        </div>


    </div>

    <div class="flex justify-between mt-8">
        <a href="{{ route('admin.clients.index') }}"
            class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            Retour
        </a>

        <div class="flex gap-2">
            <a href="{{ route('admin.clients.edit', $client) }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Éditer
            </a>

            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection