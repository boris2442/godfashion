<aside id="sidebar"
    class="min-w-64 header-home
bg-color1  text-color2  shadow-lg min-h-screen fixed z-40 left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 md:fixed md:block block md:min-w-64 "
    style="width: 16rem;">

    <div class="h-16 flex items-center justify-center uppercase text-color2 font-bold text-xl titleentreprise">
        GODFASHION
    </div>
    <nav class="mt-6 px-4 space-y-2">

        <a 
        {{-- href="{{ route('home') }}" --}}
         class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-home mr-2"></i> Accueil
        </a>


        <a
         {{-- href="{{ route('admin.dashboard') }}"  --}}
        class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-chart-line mr-2"></i> Tableau de bord
        </a>
        {{-- @auth
        @if (auth()->user()->role==='admin') --}}

        <a
         {{-- href="{{ route('messages.index') }}" --}}
          class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-envelope mr-2"></i> Messages
        </a>

        <a
         {{-- href="{{ route('boutique.admin') }}" --}}
          class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-book mr-2"></i> Boutiques
        </a>
        <a
         {{-- href="{{ route('admin.blogs.index') }}" --}}
          class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-layer-group mr-2"></i> Blogs
        </a>
        {{-- <a href="{{ route('specialites.index') }}" class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-certificate mr-2"></i> Spécialités
        </a> --}}

        {{-- @endauth --}}
        <a
         {{-- href="{{ route('users.index') }}" --}}
          class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-users mr-2"></i> Utilisateurs
        </a>

        <a 
        {{-- href="{{ route('admin.services.index') }}" --}}
         class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-concierge-bell mr-2"></i> Services
        </a>
        {{-- @endif
        @endauth --}}


        {{-- @auth
        @if(auth()->user()->role==='comptable') --}}
        <a {{-- href="{{ route('paiements.index') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-credit-card mr-2"></i> Paiements
        </a>
        {{-- @endif
        @endauth --}}
        {{-- <a href="{{ route('logout') }}"
            class="block py-2.5 px-4 rounded transition duration-200 bg-red-500 hover:bg-red-600 hover:text-white text-white dark:text-gray-200 ">
            <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
        </a> --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="block w-full text-left py-2.5 px-4 rounded transition duration-200 bg-red-500 hover:bg-red-600 hover:text-white text-white dark:text-gray-200">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </button>
        </form>

    </nav>
</aside>

<!-- Overlay pour mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-color3 bg-opacity-40 z-30 hidden md:hidden" onclick="toggleSidebar()">
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const isOpen = sidebar.classList.contains('translate-x-0');
        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
        }
    }
</script>