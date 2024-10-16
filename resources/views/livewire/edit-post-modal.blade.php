<div class="h-[40rem] lg:flex lg:flex-row overflow-y-auto">

    {{-- Left Side --}}
    <div class="flex h-1/2 lg:h-full items-center justify-center overflow-hidden bg-black lg:w-8/12">
        <img class="h-full w-full object-cover" src="{{ $newImage ? $newImage->temporaryUrl() : '/storage/app/public/' . $post->image }}" alt="Post Image">
    </div>
    
    {{-- Right Side --}}
    <div class="lg:w-4/12 flex flex-col bg-white p-5">

        {{-- User Info --}}
        <div class="flex flex-row items-center mb-4">
            <div>
                <img src="{{ auth()->user()->image }}" class="w-10 h-10 mr-2 rounded-full border border-neutral-300" alt="User Image">
            </div>
            <div class="flex flex-col">
                <div class="font-bold">
                    <a href="/{{ auth()->user()->username }}">{{ auth()->user()->username }}</a>
                </div>
            </div>
        </div>

        {{-- Image Update Field --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2" for="newImage">{{ __('Update Image') }}</label>
            <input type="file" id="newImage" wire:model="newImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
            @error('newImage')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            {{-- Show Preview if New Image is Selected --}}
            @if ($newImage)
                <div class="mt-3">
                    <img src="{{ $newImage->temporaryUrl() }}" class="h-32 w-32 object-cover rounded-lg" alt="Preview Image">
                </div>
            @endif
        </div>

        {{-- Text Area --}}
        <div class="flex-grow mt-3 mb-6">
            <textarea placeholder="{{ __('Write description ... ') }}" wire:model="description" 
            class="border border-neutral-300 rounded-lg h-32 w-full resize-none p-3 focus:ring-2 focus:ring-blue-500" required></textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Update Button --}}
        <div class="flex justify-center">
            <button wire:click="update" class="bg-blue-500 text-white w-full py-3 rounded-lg hover:bg-blue-600 transition duration-200">
                {{__('Update')}}
            </button>
        </div>
    </div>
</div>
