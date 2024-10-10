<div>
    @if($follow_state == "Pending")
        <span class="{{$classes2}} w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded">{{__('Pending')}}</span>
    @else
        <button wire:click="toggle_follow"
        class="{{$classes}} w-30 cursor-pointer text-sm font-bold py-1 px-3 text-center rounded">{{__($follow_state)}}
        </button>
    @endif
</div>