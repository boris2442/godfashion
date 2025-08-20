<aside id="sidebar"
    class="min-w-64 header-home
bg-blue-600 

  text-white  shadow-lg min-h-screen fixed z-40 left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 md:fixed md:block block md:min-w-64 "
    style="width: 16rem;">

    <div class="h-16 flex items-center justify-center uppercase text-white font-bold text-xl titleentreprise">
        GODFASHION
    </div>
    <nav class="mt-6 px-4 space-y-2">

        <a {{-- href="{{ route('home') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-home mr-2"></i> Accueil
        </a>


        <a {{-- href="{{ route('admin.dashboard') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-chart-line mr-2"></i> Tableau de bord
        </a>
        {{-- @auth
        @if (auth()->user()->role==='admin') --}}



        <a href="{{ route('admin.clients.index') }}" {{-- class="block py-2.5 px-4 rounded transition duration-200 "
            --}} class="flex items-center py-2.5 px-4 rounded-lg transition duration-200
          hover:bg-blue-600 hover:text-white
          {{ request()->routeIs('admin.clients.index') ? 'bg-blue-700 text-white' : 'text-gray-200' }}">
            <i class="fas fa-book mr-2"></i> Clients
        </a>
        <a href="{{ route('admin.commandes.index') }}" class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-layer-group mr-2"></i> Commandes
        </a>
        <a {{-- href="{{ route('admin.blogs.index') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-credit-card mr-2"></i> Paiements
        </a>
        <a {{-- href="{{ route('admin.blogs.index') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-boxes mr-2"></i> Stocks
        </a>

        <a {{-- href="{{ route('users.index') }}" --}} class="block py-2.5 px-4 rounded transition duration-200 ">
            <i class="fas fa-users mr-2"></i> Utilisateurs
        </a>





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