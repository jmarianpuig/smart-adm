<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" x-data="{ open: false, show: localStorage.dark == 1 ? true : false, toggle() { this.show = !this.show } }">
    <!-- Primary Navigation Menu -->
    <div class="xs:w-full xl:w-7/12 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logos/logo.png') }}"
                            class="block h-12 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @can('extras.index')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link :href="route('extras.index')" :active="request()->routeIs('extras.index')">
                            Figurantes
                        </x-nav-link>
                    </div>
                @endcan
                @can('actors.index')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link :href="route('actors.index')" :active="request()->routeIs('actors.index')">
                            Actores
                        </x-nav-link>
                    </div>
                @endcan

                @canany(['youngers.extras.index', 'youngers.actors.index'])
                    <div class="hidden space-x-8 sm:items-center sm:-my-px sm:ml-6 sm:flex">
                        <x-dropdown align="right" width="48">

                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center p-0 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>Smart Kids</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @can('youngers.extras.index')
                                    <x-dropdown-link :href="route('youngers.extras.index')">
                                        Figurantes
                                    </x-dropdown-link>
                                @endcan
                                @can('youngers.actors.index')
                                    <x-dropdown-link :href="route('youngers.actors.index')">
                                        Actores
                                    </x-dropdown-link>
                                @endcan
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endcanany

                @can('coordinators.index')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link :href="route('coordinators.index')" :active="request()->routeIs('coordinators.index')">
                            Coordinadores
                        </x-nav-link>
                    </div>
                @endcan

                @can('events.index')
                    <div class="hidden space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                            Eventos TV
                        </x-nav-link>
                    </div>
                @endcan

                @can('users.index')
                    <div class="hidden space-x-8 sm:items-center sm:-my-px sm:ml-6 sm:flex">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center p-0 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>Gestión App</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('users.index')">
                                    Usuarios
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('roles.index')">
                                    Roles y Permisos
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endcan
            </div>

            <!-- Settings Dropdown -->

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Selector de tema oscuro -->
                <div class="mr-2">
                    <svg id="moon" class="setMode h-4 w-4 text-gray-400 hover:text-gray-500 cursor-pointer"
                        fill="none" @click="toggle" :class="{ 'block': !show, 'hidden': show }" x-cloak
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg id="sun" class="setMode h-5 w-5 text-yellow-200 hover:text-yellow-300 cursor-pointer"
                        fill="none" @click="toggle" :class="{ 'hidden': !show, 'block': show }" x-cloak
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>¡Hola, {{ Auth::user()->name }}!</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>


            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Dark Mode -->
        <div class="py-4 border-y border-gray-400 dark:border-gray-600  bg-gray-300 dark:bg-gray-900">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">¡Hola, {{ Auth::user()->name }}!
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Inicio
            </x-responsive-nav-link>
            @can('extras.index')
                <x-responsive-nav-link :href="route('extras.index')" :active="request()->routeIs('extras.index')">
                    Figurantes
                </x-responsive-nav-link>
            @endcan
            @can('actors.index')
            <x-responsive-nav-link :href="route('actors.index')" :active="request()->routeIs('actors.index')">
                Actores
            </x-responsive-nav-link>
            @endcan
            @canany(['youngers.extras.index', 'youngers.actors.index'])
                <div class="py-2 border-y border-gray-400 dark:border-gray-600 bg-gray-300 dark:bg-gray-900">
                    <div class="px-4">
                        <div class="font-bold text-base text-gray-800 dark:text-gray-200">Smart Kids</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                @can('youngers.extras.index')
                    <x-responsive-nav-link :href="route('youngers.extras.index')" :active="request()->routeIs('youngers.extras.index')">
                        Figurantes
                    </x-responsive-nav-link>
                @endcan

                @can('youngers.actors.index')
                    <x-responsive-nav-link :href="route('youngers.actors.index')" :active="request()->routeIs('youngers.actors.index')">
                        Actores
                    </x-responsive-nav-link>
                </div>
                @endcan
            @endcanany
            @can('coordinators.index')
                <div class="py-2 border-y border-gray-400 dark:border-gray-600 bg-gray-300 dark:bg-gray-900">
                    <div class="px-4">
                        <div class="font-bold text-base text-gray-800 dark:text-gray-200">Coordinadores</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                @can('coordinators.index')
                    <x-responsive-nav-link :href="route('coordinators.index')" :active="request()->routeIs('coordinators.index')">
                        Coordinadores
                    </x-responsive-nav-link>
                @endcan
            @endcan
            @can('user.index')    
                <div class="py-2 border-y border-gray-400 dark:border-gray-600 bg-gray-300 dark:bg-gray-900">
                    <div class="px-4">
                        <div class="font-bold text-base text-gray-800 dark:text-gray-200">Gestión App</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        Usuarios
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">
                        Roles y Permisos
                    </x-responsive-nav-link>
                </div>
            @endcan
            <div class="py-2 border-y border-gray-400 dark:border-gray-600 bg-gray-300 dark:bg-gray-900">
                <div class="px-4">
                    <div class="font-bold text-base text-gray-800 dark:text-gray-200">Aplicaciones</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                    Eventos TV
                </x-responsive-nav-link>

                <x-responsive-nav-link>
                    Castings (en preparación)
                </x-responsive-nav-link>

            </div>
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>


    </div>
</nav>
