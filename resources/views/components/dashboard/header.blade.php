<!-- Top bar -->
<!-- Top bar -->
<header class="h-16 bg-color1  shadow
 flex items-center
 fixed top-0 right-0 w-full
  px-6 z-10">
    <!-- Bouton hamburger visible uniquement sur mobile -->
    <button class="md:hidden p-2 text-color2 focus:outline-none mr-2" onclick="toggleSidebar()">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <div class="flex-1">
        <!-- Espace pour titres, breadcrumb, etc. -->
    </div>
    <div class="flex items-center space-x-4">
        {{-- @auth --}}
        <span class="text-color2 text-[12px] font-bold">Bienvenue,

            {{-- {{auth()->user()->name}} --}}
        </span>

        {{-- @endauth --}}
        {{-- <a href="#" class="text-red-500 hover:text-red-700"> <i
                class="fas fa-sign-out-alt mr-2"></i>Déconnexion</a> --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="block w-full text-[12px] text-left py-1 md:py-2.5 px-4 rounded transition duration-200 bg-red-500 hover:bg-red-600 hover:text-white text-white dark:text-gray-200">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </button>
        </form>
    </div>
</header>