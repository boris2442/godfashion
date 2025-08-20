@extends('layouts.admin.layout-admin')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des commandes</h1>

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
                    @if($commande->image_tissu)
                    @foreach(json_decode($commande->image_tissu) as $image)
                    <img src="{{ asset('storage/'.$image) }}" alt="Tissu" class="w-16 h-16 object-cover mb-1">
                    @endforeach
                    @else
                    <span>Aucune image</span>
                    @endif
                </td> --}}
                <td class="px-4 py-2 border">
                    @if($commande->image_tissu && json_decode($commande->image_tissu))
                    <!-- Swiper -->
                    <div class="swiper mySwiper w-32 h-32">
                        <div class="swiper-wrapper">
                            @foreach(json_decode($commande->image_tissu) as $imagePath)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Tissu"
                                    class="w-full h-full object-cover rounded">
                            </div>
                            @endforeach
                        </div>
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
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
            });
        });
    });
</script>
@endsection