{{-- resources/views/clients/edit.blade.php --}}
@extends('layouts.admin.layout-admin')

@section('title', 'Modifier un client')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-neutral-900 py-10">
  <div class="max-w-2xl mx-auto px-4">
    <div class="bg-white dark:bg-neutral-800 border border-gray-200/70 dark:border-neutral-700 rounded-2xl shadow-lg">
      <div class="p-6 sm:p-8">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Modifier un client</h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-neutral-300">
          Mettez à jour les informations du client.
        </p>

        <form action="{{ route('admin.clients.update', $client) }}" method="POST" class="mt-8 space-y-6">
          @csrf
          @method('PUT')

          {{-- Nom --}}
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-neutral-200">
              Nom <span class="text-red-600">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              value="{{ old('name', $client->name) }}"
              class="mt-1 w-full rounded-xl border border-gray-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 px-4 py-2.5 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            >
            @error('name')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Téléphone --}}
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-neutral-200">
              Téléphone <span class="text-red-600">*</span>
            </label>
            <input
              type="tel"
              id="phone"
              name="phone"
              value="{{ old('telephone', $client->phone) }}"
              class="mt-1 w-full rounded-xl border border-gray-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 px-4 py-2.5 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              required
            >
            @error('phone')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          {{-- Adresse --}}
          <div>
            <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-neutral-200">
              Adresse
            </label>
            <textarea
              id="adresse"
              name="adresse"
              rows="3"
              class="mt-1 w-full rounded-xl border border-gray-300 dark:border-neutral-600 bg-white dark:bg-neutral-900 px-4 py-2.5 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >{{ old('adresse', $client->adresse) }}</textarea>
            @error('adresse')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

       

          {{-- Actions --}}
          <div class="pt-2 flex items-center gap-3">
            <button
              type="submit"
              class="inline-flex items-center justify-center rounded-2xl px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-md"
            >
              Mettre à jour
            </button>
            <a
              href="{{ route('admin.clients.index') }}"
              class="inline-flex items-center justify-center rounded-2xl px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-neutral-200 bg-gray-100 dark:bg-neutral-700 hover:bg-gray-200 dark:hover:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-gray-300"
            >
              Annuler
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
