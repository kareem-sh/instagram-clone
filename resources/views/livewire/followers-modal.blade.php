<div class="max-h-96 flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Modal Header -->
    <div class="flex w-full items-center justify-between border-b border-neutral-100 p-4">
        <h1 class="text-lg font-bold text-center flex-grow">{{ __('followers') }}</h1>
        <button wire:click="$dispatch('closeModal')" class="text-neutral-500 hover:text-neutral-700 transition">
            <i class="bx bx-x text-2xl"></i>
        </button>
    </div>

    <!-- Modal Body (follower List) -->
    <ul class="overflow-y-auto px-4 py-2">
        @forelse($this->followers_list as $follower)
            <li class="flex items-center p-3 border-b border-neutral-100 last:border-0" wire:key="following-{{ $follower->id }}">
                <!-- User Avatar -->
                <div class="mr-3">
                    <img src="{{ $follower->image }}" class="w-10 h-10 rounded-full border border-neutral-300" alt="{{ $follower->username }}">
                </div>

                <!-- User Info -->
                <div class="flex-grow">
                    <div class="font-bold text-sm">
                        <a href="/{{ $follower->username }}" class="hover:text-blue-500 transition">{{ $follower->username }}</a>
                    </div>
                    <div class="text-neutral-500 text-xs">{{ $follower->name }}</div>
                </div>

                <!-- Unfollow Button (Visible only for authenticated users) -->
                @auth
                <div>
                    <!-- Call the unfollow method and pass the user's ID -->
                    @if ($this->user->is_following($follower))
                    <button class="border border-gray-300 px-3 py-1 rounded text-xs font-medium text-white bg-blue-500 transition" wire:click="toggle_follow({{ $follower->id }})">
                        {{ __('Unfollow') }}
                    </button>
                    @elseif ($this->user->is_pending($follower))
                    <button class="border border-gray-300 px-3 py-1 rounded text-xs font-medium text-white bg-gray-400 transition cursor">
                        {{ __('Pending') }}
                    </button>
                    @else
                    <button class="border border-gray-300 px-3 py-1 rounded text-xs font-medium text-white bg-blue-500 transition" wire:click="toggle_follow({{ $follower->id }})">
                        {{ __('Follow') }}
                    </button>
                    @endif
                    
                </div>
                @endauth
            </li>
        @empty
            <!-- Empty State -->
            <li class="w-full p-4 text-center text-neutral-500">
                {{ __('You Do not have any follower') }}
            </li>
        @endforelse
    </ul>
</div>
