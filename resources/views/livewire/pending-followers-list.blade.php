<div class="max-h-96 w-72 md:w-96 flex flex-col bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="divide-y divide-neutral-200 overflow-auto">
        @forelse(auth()->user()->pending_followers as $pending)
            <div class="flex items-center p-4">
                <!-- User Avatar -->
                <div class="mr-4 shrink-0">
                    <img src="{{ $pending->image }}" class="w-12 h-12 rounded-full border border-neutral-300"
                        alt="{{ $pending->username }}'s avatar">
                </div>

                <!-- User Info -->
                <div class="flex-grow">
                    <div class="font-semibold text-sm">
                        <a href="/{{ $pending->username }}" class="hover:text-blue-500 transition duration-300">
                            {{ $pending->username }}
                        </a>
                    </div>
                    <div class="text-neutral-500 text-xs">
                        {{ $pending->name }}
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <button class="border border-blue-500 bg-blue-500 text-white px-3 py-1 rounded text-sm transition duration-300 hover:bg-blue-600"
                        wire:click="confirm({{ $pending->id }})">
                        {{ __('Confirm') }}
                    </button>
                    <button class="border border-neutral-300 bg-neutral-100 text-neutral-700 px-3 py-1 rounded text-sm transition duration-300 hover:bg-neutral-200"
                        wire:click="delete({{ $pending->id }})">
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="w-full p-4 text-sm text-center text-neutral-500">
                {{ __('You have no pending followers.') }}
            </div>
        @endforelse
    </div>
</div>
