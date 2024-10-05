<x-app-layout>
    <div id="flash-message"  class="{{session('success') ? '' : 'hidden'}} w-50 p-4 mb-4 text-sm tex-green-700 bg-green-100 rounded-lg absloute right-10 shadow shadow-nuteral-200" role="alert">
        <span  class="font-medium">{{session('success')}}</span>
    </div>
    <div class="container mx-auto px-4 py-8 w-full md:w-8/12">
        <!-- Profile Section (centered) -->
        <div class="flex flex-col items-center">
            <div class="w-full flex justify-between items-start">
                <!-- Profile Picture -->
                <div class="relative">
                    <img src="{{$user->image}}" alt="{{$user->username}}'s profile picture"
                         class="rounded-full w-32 h-32 md:w-40 md:h-40 border-4 border-neutral-200 object-cover">
                </div>

                <!-- User Info Section -->
                <div class="ml-12 flex-1">
                    <div class="flex items-center mb-2 mt-3">
                        <!-- Username -->
                        <div class="text-2xl md:text-3xl font-semibold mr-4 mb-2">{{$user->username}}</div>

                        <!-- Edit Profile / Follow Buttons -->
                        @if ($user->id == auth()->id())
                            <a href="/{{$user->username}}/edit"
                               class="border text-sm font-semibold py-1 px-4 rounded-md border-neutral-300 text-center">
                                {{__('Edit Profile')}}
                            </a>
                        @endif
                        @if ($user->id != auth()->id())
                        <a href="#" class="border text-sm font-semibold py-1 px-4 ml-2 rounded-md border-neutral-300 text-center">
                            {{__('Follow')}}
                        </a>
                        @endif
                    </div>

                    <!-- Follow/Followers/Posts Count -->
                    <div class="flex space-x-8 mb-4">
                        <div>
                            {{$user->posts->count()}}<span class="font-bold">{{ $user->posts->count() > 1 ? ' posts' : ' post' }}</span>
                        </div>
                        <div>
                            {{-- <span class="font-bold">{{ $user->followers->count() }}</span> {{__('followers')}} --}}
                        </div>
                        <div>
                            {{-- <span class="font-bold">{{ $user->following->count() }}</span> {{__('following')}} --}}
                        </div>
                    </div>

                    <!-- User Bio -->
                    <div class="text-sm">
                        <p class="font-bold">{{$user->name}}</p>
                        <p>{!! nl2br(e($user->bio)) !!}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs (Posts/Reels/Tagged) -->
        <div class="border-t border-neutral-300 pt-4 mb-6 mt-6 text-center">
            <div class="flex justify-center space-x-8">
                <a href="#" class="text-sm font-semibold text-gray-700">{{__('Posts')}}</a>
                <a href="#" class="text-sm text-gray-500">{{__('Reels')}}</a>
                <a href="#" class="text-sm text-gray-500">{{__('Tagged')}}</a>
            </div>
        </div>

        <!-- Posts Grid -->
        @if ($user->private_account && auth()->id() !== $user->id)
            <div class="w-full text-center mt-20">
                {{__('This Account is Private. Follow to see their photos')}}
            </div>
        @else
            @if ($user->posts->count() === 0)
                <div class="w-full text-center mt-20">
                    {{__('This account has no posts yet.')}}
                </div>
            @else
                <div class="grid grid-cols-3 gap-1 my-5 md:gap-4">
                    @foreach($user->posts as $post)
                        <a href="/p/{{ $post->slug }}" class="relative">
                            <img src="storage/app/public/{{ $post->image }}" alt="Post by {{$user->username}}"
                                 class="w-full h-full object-cover">
                            @if($post->is_pinned)
                                <div class="absolute top-2 left-2 bg-white rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
        @endif
       
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(function() {
                    flashMessage.style.opacity = '0'; 
                    setTimeout(function() {
                        flashMessage.style.display = 'none'; 
                    }, 500);
                }, 3000); 
            }
        });
    </script>

    <style>
        #flash-message {
            transition: opacity 0.8s ease-out; /* Smooth fade out */
        }
    </style>

</x-app-layout>
