<x-app-layout>

    <!-- Main Container -->
    <div class="flex flex-col lg:flex-row max-w-4xl gap-8 mx-auto">

        {{-- Left-side (Posts Section) --}}
        <livewire:post-list />
        
        {{-- Right-side (Suggestions Section) --}}
        <div class="hidden lg:flex lg:flex-col lg:w-[40%] pt-4">

            <!-- User Info -->
            <div class="flex items-center mb-6">
                <a href="/{{ auth()->user()->username }}" class="mr-4">
                    <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->username }}"
                        class="border border-gray-300 rounded-full h-12 w-12" />
                </a>
                <div>
                    <a href="/{{ auth()->user()->username }}"
                        class="font-bold text-sm hover:text-blue-500 transition duration-300">
                        {{ auth()->user()->username }}
                    </a>
                    <div class="text-gray-500 text-xs">{{ auth()->user()->name }}</div>
                </div>
            </div>

            <!-- Suggestions Section -->
            <div>
                <h3 class="text-gray-500 font-semibold mb-4">{{ __('Suggestions For You') }}</h3>
                <ul>
                    @foreach ($suggested_users as $suggested_user)
                        <li class="flex items-center justify-between my-4">
                            <!-- User Avatar -->
                            <a href="/{{ $suggested_user->username }}" class="mr-4 shrink-0">
                                <img src="{{ $suggested_user->image }}" alt="{{ $suggested_user->username }}"
                                    class="border border-gray-300 rounded-full h-9 w-9" />
                            </a>

                            <!-- Username and Follower Status -->
                            <div class="flex-grow truncate">
                                <a href="/{{ $suggested_user->username }}"
                                    class="font-bold text-sm hover:text-blue-500 transition duration-300 truncate">
                                    {{ $suggested_user->username }}
                                    @if (auth()->user()->is_follower($suggested_user))
                                        <span class="text-xs text-gray-500">{{ __('Follower') }}</span>
                                    @endif
                                </a>
                            </div>


                            <!-- Follow Button -->
                            <livewire:follow-button :userId="$suggested_user->id" :classes="'text-blue-500 hover:text-blue-600 transition duration-300'" :classes2="'text-gray-500 hover:text-gray-600 transition duration-300'" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</x-app-layout>
