  <div>
    <button onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} } })" class="font-bold">{{ $this->count }} {{ __('following') }}</button>
</div>