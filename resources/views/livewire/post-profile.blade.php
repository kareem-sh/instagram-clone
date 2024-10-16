@if ($this->user->private_account && auth()->id() !== $this->user->id)
   @auth
       @if (auth()->user()->is_following($this->user))
           <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-5">
               @foreach($this->posts as $post)
                   <a href="/p/{{ $post->slug }}" class="relative">
                       <img src="storage/app/public/{{ $post->image }}" alt="Post by {{ $this->user->username }}" class="w-full h-48 object-cover rounded-lg">
                   </a>
               @endforeach
           </div>
       @else
           <div class="w-full text-center mt-20">
               {{ __('This Account is Private. Follow to see their photos') }}
           </div>
       @endif
   @endauth
   @guest
       <div class="w-full text-center mt-20">
           {{ __('This Account is Private. Follow to see their photos') }}
       </div>
   @endguest
@else
   @if ($this->posts->count() === 0)
       <div class="w-full text-center mt-20">
           {{ __('This account has no posts yet.') }}
       </div>
   @else
       <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-5">
           @foreach($this->posts as $post)
               <a href="/p/{{ $post->slug }}" class="relative">
                   <img src="storage/app/public/{{ $post->image }}" alt="Post by {{ $this->user->username }}" class="w-full h-48 object-cover rounded-lg">
               </a>
           @endforeach
       </div>
   @endif
@endif
    </div>