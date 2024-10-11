<div>
    @if($follow_state == "Pending")
        <!-- Use a button but make it non-clickable -->
        <button class="{{ $classes2 }} w-28 text-center text-sm font-bold py-1 px-3 rounded cursor"
                disabled>
            {{ __('Pending') }}
        </button>
    @else
        <button wire:click="toggle_follow"
                class="{{ $classes }} w-28 text-center cursor-pointer text-sm font-bold py-1 px-3 rounded">
            {{ __($follow_state) }}
        </button>
    @endif
</div>
