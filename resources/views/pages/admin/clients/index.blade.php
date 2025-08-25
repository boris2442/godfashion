{{-- resources/views/clients/index.blade.php --}}
@extends('layouts.admin.layout-admin')

@section('title', 'Liste des clients')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-neutral-900 py-10">
  <div class="max-w-6xl mx-auto px-4">

    {{-- Header --}}
    {{-- <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Liste des clients</h1>
      <a href="{{ route('admin.clients.create') }}"
        class="inline-flex items-center rounded-2xl px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-md">
        + Nouveau client
      </a>
    </div> --}}
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold">Liste des clients</h1>

      <!-- Bouton d'actions -->
      <div class="relative inline-block text-left">
        <button onclick="toggleDropdown()"
          class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">
          Actions
          <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>

        <!-- Dropdown -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50">
          <a href="{{ route('admin.clients.create') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">➕ Ajouter une client</a>
          <a {{-- href="{{ route('commandes.import') }}" --}}
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">⬆️ Importer</a>
          <a {{-- href="{{ route('commandes.export') }}" --}}
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">⬇️ Exporter</a>
        </div>
      </div>
    </div>

    <script>
      function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }
    </script>
    {{-- Table --}}
    <div
      class="overflow-x-auto rounded-2xl shadow-lg border border-gray-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
        <thead class="bg-gray-100 dark:bg-neutral-700/50">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-neutral-200">Nom</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-neutral-200">Téléphone</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-neutral-200">Adresse</th>

            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-neutral-200">Voir plus</th>
            <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700 dark:text-neutral-200">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
          @forelse($clients as $client)
          <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/30">
            <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $client->name }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-200">{{ $client->phone }}</td>
            <td class="px-6 py-4 text-sm text-gray-700 dark:text-neutral-300">{{ $client->adresse ?? '—' }}</td>

            <td class="px-6 py-4">
              <a href="{{ route('admin.clients.show', $client) }}"
                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                Voir plus
              </a>
            </td>
            <td class="px-6 py-4 text-right text-sm flex justify-end gap-2">
              {{-- Bouton Éditer --}}
              <a href="{{ route('admin.clients.edit', $client) }}"
                class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
                Éditer
              </a>

              {{-- Bouton Supprimer --}}
              <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm">
                  Supprimer
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-6 text-center text-sm text-gray-500 dark:text-neutral-400">
              Aucun client trouvé.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $clients->links() }}
    </div>
  </div>
</div>
@endsection