<nav class="bg-gray-100 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a class="text-lg font-bold w-full mr-20" href="#">Mi Tienda</a>
        <button class="block lg:hidden focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>


        <div class="text-sm flex justify-between w-full align-middle items-center">
            <div>


                <x-nav-link href="{{ route('home') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-800 hover:text-gray-600 mr-4">
                    Productos
                </x-nav-link>

            </div>
            <div>
                <x-nav-link href="{{ route('cart') }}" :active="request()->routeIs('cart')" class="text-gray-800 hover:text-gray-600 mr-8">
                    <svg viewBox="0 0 24 24" class="w-4 h-4 mr-4" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path d="M7.2998 5H22L20 12H8.37675M21 16H9L7 3H4M4 8H2M5 11H2M6 14H2M10 20C10 20.5523 9.55228 21 9 21C8.44772 21 8 20.5523 8 20C8 19.4477 8.44772 19 9 19C9.55228 19 10 19.4477 10 20ZM21 20C21 20.5523 20.5523 21 20 21C19.4477 21 19 20.5523 19 20C19 19.4477 19.4477 19 20 19C20.5523 19 21 19.4477 21 20Z" stroke="#2d7406" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>

                    Carrito ({{ count(Session::get('cart', [])) }})
                </x-nav-link>
                @auth
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-gray-800 hover:text-gray-600 mr-4">
                    {{ __('Dashboard') }}
                </x-nav-link>

                @else
                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')" class="text-gray-800 hover:text-gray-600 mr-4">
                    Iniciar Sesión
                </x-nav-link>
                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')" class="text-gray-800 hover:text-gray-600">
                    Registrarse
                </x-nav-link>
                @endauth
            </div>

        </div>

    </div>
</nav>
