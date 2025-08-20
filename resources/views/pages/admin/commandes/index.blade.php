@extends('layouts.admin.layout-admin')

@section('content')
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
                <th class="px-4 py-2 border">Client</th>
                <th class="px-4 py-2 border">Type d’habit</th>
                <th class="px-4 py-2 border">Tissu</th>
                <th class="px-4 py-2 border">Mesures</th>
                <th class="px-4 py-2 border">Prix total</th>
                <th class="px-4 py-2 border">Avance</th>
                <th class="px-4 py-2 border">Statut</th>
                <th class="px-4 py-2 border">Date de livraison</th>
                <th class="px-4 py-2 border">Images</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td class="px-4 py-2 border">{{ $commande->client->name ?? 'Inconnu' }}</td>
                <td class="px-4 py-2 border">{{ $commande->type_habit }}</td>
                <td class="px-4 py-2 border">{{ $commande->tissu }}</td>
                <td class="px-4 py-2 border">{{ $commande->mesures }}</td>
                <td class="px-4 py-2 border">{{ $commande->prix_total }} FCFA</td>
                <td class="px-4 py-2 border">{{ $commande->avance }} FCFA</td>
                <td class="px-4 py-2 border">{{ $commande->statut }}</td>
                <td class="px-4 py-2 border">{{ $commande->date_livraison->format('d/m/Y') }}</td>



                {{-- <td class="px-4 py-2 border">
                    @if($commande->images->count())
                    @if($commande->images->count() === 1)

                    <img src="{{ asset('storage/' . $commande->images->first()->chemin_image) }}" alt="Tissu"
                        class="w-32 h-32 object-cover rounded">
                    @else

                    <div class="swiper mySwiper w-32 h-32">
                        <div class="swiper-wrapper">
                            @foreach($commande->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->chemin_image) }}" alt="Tissu"
                                    class="w-full h-full object-cover rounded">
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    @endif
                    @else
                    <span>Aucune image</span>
                    @endif
                </td> --}}
                <td class="px-4 py-2 border">
                    @if($commande->images->count())
                    @if($commande->images->count() === 1)
                    <img src="{{ asset('storage/' . $commande->images->first()->chemin_image) }}" alt="Tissu"
                        class="w-32 h-32 object-cover rounded">
                    @else
                    <div class="swiper mySwiper w-32 h-32">
                        <div class="swiper-wrapper">
                            @foreach($commande->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->chemin_image) }}" alt="Tissu"
                                    class="w-full h-full object-cover rounded">
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    @endif
                    @else
                    <span>Aucune image</span>
                    @endif
                </td>


                <td class="px-4 py-2 border">
                    <a href="{{ route('admin.commandes.edit', $commande->id) }}"
                        class="text-blue-500 hover:underline">Modifier</a>
                    <form action="{{ route('admin.commandes.destroy', $commande->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline"
                            onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $commandes->links() }}
    </div>
</div>
<!-- JS Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const swipers = document.querySelectorAll('.mySwiper');
    if(swipers.length){
        swipers.forEach(swiperEl => {
            new Swiper(swiperEl, {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                pagination: {
                    el: swiperEl.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: swiperEl.querySelector('.swiper-button-next'),
                    prevEl: swiperEl.querySelector('.swiper-button-prev'),
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 10,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 20,
                    },
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });
    }
});


</script>



@endsection