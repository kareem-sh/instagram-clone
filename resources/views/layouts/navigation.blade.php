<nav x-data="{ open: false, showPending: false }" 
    class="bg-white border-b border-gray-200" 
    :class="{ 'rtl': '{{ app()->getLocale() == 'ar' ? 'true' : 'false' }}', 'ltr': '{{ app()->getLocale() == 'en' ? 'true' : 'false' }}' }">
    
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="shrink-0 flex items-center">
                <!-- Logo -->
                <a href="{{ route('home_page') }}">
                    <x-application-logo class="block h-auto w-32 fill-current text-gray-800" />
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-grow hidden sm:flex sm:items-center justify-center">
                <livewire:search />
            </div>

            <!-- Settings and Icons Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <div class="flex items-center space-x-6">
                        <div class="space-x-4 text-[1.3rem] mr-5 leading-5 flex items-center">
                            <a href="{{ route('home_page') }}" class="text-gray-800 hover:text-blue-500 transition rtl:ml-4">
                                {!! url()->current() == route('home_page') ? '<i class="bx bxs-home-alt-2"></i>' : '<i class="bx bx-home-alt-2"></i>' !!}
                            </a>
                            <a href="{{ route('explore') }}" class="text-gray-800 hover:text-blue-500 transition">
                                {!! url()->current() == route('explore') ? '<i class="bx bxs-compass"></i>' : '<i class="bx bx-compass"></i>' !!}
                            </a>

                            <button onclick="Livewire.dispatch('openModal', { component: 'create-post-modal' })" class="text-gray-800 hover:text-blue-500 transition">
                                <i class="bx bx-message-square-add"></i>
                            </button>

                            <!-- Inbox Icon with Dropdown for Pending Followers -->
                            <div class="relative">
                                <i class='bx bxs-inbox cursor-pointer text-gray-800 hover:text-blue-500 transition' @click="showPending = !showPending"></i>
                                <livewire:pending-followers-count />
                                <!-- Pending Followers Dropdown -->
                                <div x-show="showPending" @click.away="showPending = false" class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-96 bg-white border border-gray-200 rounded-lg" style="display: none;">
                                    <livewire:pending-followers-list />
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endauth

                <div class="hidden md:block">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <img src="{{ auth()->user()->image }}" class="w-8 h-8 rounded-full">
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('user_profile', ['user' => auth()->user()->username])" class="text-gray-800 hover:text-gray-600">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-gray-800 hover:text-gray-600">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @endauth

                    <!-- Login and Register Links -->
                    @guest
                        <div class="flex space-x-4 ml-5">
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-blue-600 rounded-md font-semibold text-xs text-blue-600 uppercase tracking-widest hover:bg-blue-50">
                                {{ __('Register') }}
                            </a>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-800 transition duration-150 ease-in-out">
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
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home_page')" :active="request()->routeIs('home_page')" class="text-gray-800 hover:text-gray-600">
                {{ __('Home Page') }}
            </x-responsive-nav-link>
            @guest
                <x-responsive-nav-link :href="route('login')">{{ __('Login') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">{{ __('Register') }}</x-responsive-nav-link>
            @endguest
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('explore')">{{ __('Explore') }}</x-responsive-nav-link>
                    <x-responsive-nav-link class="cursor-pointer" onclick="Livewire.dispatch('openModal', { component: 'create-post-modal' })">{{ __('New Post') }}</x-responsive-nav-link>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-gray-800 hover:text-gray-600">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-gray-800 hover:text-gray-600">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
