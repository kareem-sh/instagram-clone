<div>
    <button onclick="Livewire.dispatch('openModal', { component: 'followers-modal', arguments: { userId: {{ $userId }} } })" class="font-bold">{{ $this->count }} {{ __('followers') }}</button>
</div>