
    <a wire:click="toggle_like">
        @if ($post->liked(auth()->user()))
        <i class="bx bxs-heart text-red-600 text-3xl hover:text-red-400 cursor-pointer mr-3"></i>
        @else
        <i class="bx bx-heart text-3xl hover:text-red-400 cursor-pointer mr-3"></i>
        @endif
        
    </a>
    <script>
    document.addEventListener('likeToggled', function (event) {
        // This will emit the event to the Likedby component
        Livewire.emit('likeToggled'); // Call the refreshLikes method in the Likedby component
    });
    
    </script>
 