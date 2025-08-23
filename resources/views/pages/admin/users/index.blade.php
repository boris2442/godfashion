@extends('layouts.admin.layout-admin')
@section('title', 'Liste des clients')
@section('content')
<section class="">
<div class="container mx-auto p-4">

    {{-- <h1 class="text-2xl font-bold mb-4">Liste des commandes</h1> --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Liste des commandes</h1>

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
                <a href="{{ route('admin.commandes.create') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">➕ Ajouter une commande</a>
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

    @if(session('success'))
    <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Id</th>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Role</th>

                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="px-4 py-2 border">{{ $user->id }}</td>
                <td class="px-4 py-2 border">{{ $user->name }}</td>
                <td class="px-4 py-2 border">{{ $user->email }}</td>
                <td class="px-4 py-2 border">{{ $user->role }}</td>
                <td class="px-4 py-2 border">
                   
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
</section>
@endsection
