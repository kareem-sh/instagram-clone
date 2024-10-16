<x-app-layout>
    <div id="flash-message" class="{{ session('success') ? '' : 'hidden' }} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    <div class="container mx-auto px-4 py-8 w-full md:w-8/12">
        <!-- Profile Section (centered) -->
        <div class="flex flex-col items-center">
            <div class="w-full flex {{ app()->getLocale() == 'ar' ? 'flex-row-reverse' : 'flex-row' }} justify-between items-start">
                <!-- Profile Picture -->
                <div class="relative {{ app()->getLocale() == 'ar' ? 'order-2' : 'order-1' }}">
                    <img src="{{ $user->image }}" alt="{{ $user->username }}'s profile picture" class="rounded-full w-32 h-32 md:w-40 md:h-40 border-4 border-neutral-200 object-cover">
                </div>

                <!-- User Info Section -->
                <div class="flex-1 {{ app()->getLocale() == 'ar' ? 'mr-12' : 'ml-12' }} {{ app()->getLocale() == 'ar' ? 'order-1' : 'order-2' }}">
                    <div class="flex items-center mb-2 mt-3">
                        <!-- Username -->
                        <div class="text-2xl md:text-3xl font-semibold {{ app()->getLocale() == 'ar' ? 'mr-6' : 'ml-4' }} mb-2">{{ $user->username }}</div>

                        <!-- Edit Profile / Follow Buttons -->
                        @auth
                            @if ($user->id == auth()->id())
                                <a href="/{{ $user->username }}/edit" class="border text-sm font-semibold py-1 px-4 rounded-md border-neutral-300 text-center rtl:mr-3 ltr:ml-3">
                                    {{ __('Edit Profile') }}
                                </a>
                            @else
                                <livewire:follow-button :userId="$user->id" :classes="'bg-blue-500 text-white'" :classes2="'bg-gray-400 text-white'" />
                            @endif
                        @endauth
                    </div>

                    <!-- Follow/Followers/Posts Count -->
                    <div class="flex space-x-8 mb-4">
                        <div class="{{ app()->getLocale() == 'ar' ? 'ml-4' : 'mr-4' }}">
                            {{ $user->posts->count() }}<span class="font-bold">{{ $user->posts->count() > 1 ? __(' posts') : __(' post') }}</span>
                        </div>
                        
                        <livewire:followers :userId="$user->id" />
                        <livewire:following :userId="$user->id" />
                    </div>

                    <!-- User Bio -->
                    <div class="text-sm">
                        <p class="font-bold">{{ $user->name }}</p>
                        <p class="mt-1">{!! nl2br(e($user->bio)) !!}</p> <!-- Add margin-top to bio -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs (Posts/Reels/Tagged) -->
        <div class="border-t border-neutral-300 pt-4 mb-6 mt-6 text-center">
        </div>

        <livewire:PostProfile :userId="$user->id" />

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    setTimeout(function() {
                        flashMessage.style.opacity = '0'; 
                        setTimeout(function() {
                            flashMessage.style.display = 'none'; 
                        }, 500);
                    }, 3000); 
                }
            });
        </script>

        <style>
            #flash-message {
                transition: opacity 0.8s ease-out; /* Smooth fade out */
            }
        </style>
    </div>
</x-app-layout>
