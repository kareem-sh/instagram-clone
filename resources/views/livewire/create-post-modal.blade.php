<div class="h-[40rem] flex flex-col justify-center">
    <div class="flex items-center border-b-2 border-neutral-100 p-2">
        <h1 class="text-lg text-center grow">{{ __('Create New Post') }}</h1>

        @if ($image)
            <button class="font-bold text-blue-400 mr-3" wire:click="save_temp">{{ __('Next') }}</button>
        @endif
    </div>

    <div class="flex-grow flex items-center justify-center">
        @if ($image)
            <img class="h-full w-full object-cover" src="{{ $image->temporaryUrl() }}" alt="Selected Image">
        @else
            <div class="grow flex flex-col h-full items-center justify-center">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50px" viewBox="0 0 24 24" width="50px" class="mb-10"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M18 20H4V6h9V4H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-9h-2v9zm-7.79-3.17l-1.96-2.36L5.5 18h11l-3.54-4.71zM20 4V1h-2v3h-3c.01.01 0 2 0 2h3v2.99c.01.01 2 0 2 0V6h3V4h-3z" />
                    </svg>
                </div>

                <div class="text-center mb-5">
                    <input type="file" class="hidden" id="fileInput" wire:model="image">
                    <x-primary-button
                    onclick="document.getElementById('fileInput').click()">{{ __('Select from computer') }}</x-primary-button>
                </div>
            </div>
        @endif
    </div>
</div>
