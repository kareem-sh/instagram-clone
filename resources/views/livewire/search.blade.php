<div class="relative flex items-center">
    <input type="text" id="searchInput" name="search" wire:model.live="searchInput"
        class="w-56 md:w-64 lg:w-96 border-none bg-gray-100 rounded-xl h-10 focus:ring-0"
        placeholder="{{ __('Search ... ') }}" autocomplete="off" />
    
    @if(!empty($searchInput))
        <button class="absolute right-3" onclick="clearInput()" wire:click="clear">
            <i class="bx bx-x-circle text-gray-400"></i>
        </button>
    @endif
    
    <div>
        @if (!empty($results) && !empty($searchInput))
            <ul class="absolute w-56 md:w-64 lg:w-96 bg-white p-2 border border-neutral-300 z-10 rounded-lg shadow-xl left-0 top-12">
                @forelse($results as $result)
                    <li class="flex flex-row w-full p-3 items-center text-sm hover:bg-gray-100 cursor-pointer"
                        wire:key="user-{{ $result->id }}"
                        wire:click="goto('{{$result->username}}')">
                        <img src="{{ $result->image }}" class="w-10 h-10 mr-2 rounded-full border border-neutral-300">
                        <div class="flex flex-col grow">
                            <div class="font-bold">
                                <a href="/{{ $result->username }}">{{ $result->username }}</a>
                            </div>
                            <div class="text-sm text-neutral-500">{{ $result->name }}</div>
                        </div>
                    </li>
                @empty
                    <li class="w-full p-3 text-center">{{ __('There are no results') }}</li>
                @endforelse
            </ul>
        @endif
    </div>
</div>

<script>
    function clearInput() {
        document.getElementById('searchInput').value = ''; // Clears the input field
        @this.clear(); // Calls the Livewire 'clear' method
    }
</script>
