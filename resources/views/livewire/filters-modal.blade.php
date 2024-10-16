<div class="h-[40rem] lg:h-[45rem] flex flex-row overflow-y-auto">

    {{-- Left Side (Image Section) --}}
    <div class="flex h-full items-center justify-center overflow-hidden bg-black w-8/12 p-0">
        <img class="h-full w-full object-cover" src="/storage/app/public/{{ $filtered_image }}" alt="Filtered Image">
    </div>

    {{-- Right Side (Filters and Details) --}}
    <div class="w-4/12 flex flex-col bg-white p-5 5xl:p-8">
        <h1 class="text-4xl font-bold text-center mb-6">Filters</h1>

        <div class="grid grid-cols-3 gap-4 items-start mb-6">
            @foreach ($filters as $filter)
                <div class="flex flex-col items-center">
                    <img src="/storage/app/public/filters_thumb/{{ $filter }}.jpg" alt="{{ $filter }}"
                        class="mb-2 cursor-pointer rounded-lg hover:ring-2 hover:ring-gray-500 transition"
                        wire:click="filter_{{ strtolower($filter) }}">
                    <span class="text-center text-gray-600 font-medium text-base">{{ $filter }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-auto flex flex-row items-center mb-4">
            <img src="{{ auth()->user()->image }}" class="w-10 h-10 mr-3 rounded-full border border-neutral-300" alt="User Image">
            <div class="flex flex-col grow">
                <div class="font-bold text-xl">
                    <a href="/{{ auth()->user()->username }}" class="hover:underline">{{ auth()->user()->username }}</a>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <textarea name="description" id="description" cols="30" rows="4"
                placeholder="{{ __('Write description ... ') }}"
                class="border border-neutral-300 rounded-lg p-3 w-full focus:ring-2 focus:ring-indigo-500 transition" wire:model="description"></textarea>
            @error('description')
                <span class="text-sm text-red-500 py-5">{{ $message }}</span>
            @enderror
            <x-primary-button class="mt-4 w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition" wire:click="publish">
                {{ __('Publish') }}
            </x-primary-button>
        </div>
    </div>
</div>
