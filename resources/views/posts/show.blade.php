<x-app-layout>
    <div class="flex justify-center items-center bg-gray-100 min-h-screen max-w-7xl">
        <div class="flex shadow-lg rounded-lg overflow-hidden" style="width: 90%; max-width: 900px; height: 100vh;">
            {{-- Left-side (Black Section) --}}
            <div class="bg-black flex items-center justify-center relative" style="width: 60%; height: 100vh;">
                <div class="relative" style="width: 100%; height: 100%;">
                    <img src="{{ asset('storage/app/public/' . $post->image) }}" alt="{{ $post->description }}" 
                         class="absolute left-1/2 transform -translate-x-1/2 h-full object-contain">
                </div>
            </div>

            {{-- Right-side (White Section - Post Info) --}}
            <div class="bg-white p-5 flex flex-col justify-between" style="width: 50%; height: 100vh;">

                {{-- Post Owner Section --}}
                <div class="border-b border-gray-300 pb-3 mb-3">
                    <div class="flex items-center">
                        <img src="{{ asset($post->owner->image) }}" alt="{{ $post->owner->username }}" class="mr-3 h-10 w-10 rounded-full">
                        <div class="grow">
                            <a href="/{{ $post->owner->username }}" class="font-bold text-gray-800">{{ $post->owner->username }}</a>
                        </div>
                       @if ($post->owner->id == auth()->id())
                           <a href="/p/{{$post->slug}}/edit"><i class="bx bx-message-square-edit text-xl"></i></a>
                       

                       <form action="/p/{{$post->slug}}/delete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">
                            <i class="bx bx-message-square-x ml-2 text-xl text-red-600"></i>
                        </button>
                       </form>
                       @endif
                    </div>
                </div>

                  {{-- Post Description --}}
                  <div class="border-b border-gray-300 pb-3 mb-3">
                    <div class="flex items-center">
                        <img src="{{ asset($post->owner->image) }}" alt="{{ $post->owner->username }}" class="mr-3 h-10 w-10 rounded-full">
                        <a href="/{{ $post->owner->username }}" class="font-bold text-gray-800">{{ $post->owner->username }}</a>
                        <span class="ml-2 text-gray-500">{{ $post->description }}</span>
                    </div>
                </div>

                {{-- Comments Section (Immediately below the username line) --}}
                <div class="flex-1 overflow-auto">
                    <div class="space-y-2">
                        {{-- Loop through comments --}}
                        @foreach($post->comments as $comment)
                        <div class="flex items-start  py-2">
                            <img src="{{ asset($comment->owner->image) }}" alt="{{ $comment->owner->username }}" class="h-100 mr-5 w-10 rounded-full">
                            <div class="flex flex-col">
                                <div>
                                    <a href="/{{ $comment->owner->username }}" class="font-bold">{{ $comment->owner->username }}</a>
                                    <span class="ml-2 text-gray-500">{{ $comment->body }}</span>
                                </div>
                                <div class="text-sm font-bold text-gray-400">{{$comment->created_at->diffForHumans(null,true,true)}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Comment Input Section --}}
                <div class="border-t pt-3">
                    <form action="/p/{{$post->slug}}/comment" method="POST">
                        @csrf
                        <div class="flex flex-row">
                            <textarea name="body" id="comment_body" placeholder="Add a comment..." class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-none focus:ring-0" rows="3"></textarea>
                            <button type="submit" class="ml-5 border-none bg-white text-blue-500">Post</button>
                        </div>
                    </form>
                </div>

                {{-- Interaction Buttons --}}
                <div class="mt-4">
                    <div class="flex justify-between items-center mb-3">
                        <button class="text-gray-600 hover:text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </button>
                        <button class="text-gray-600 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm1 3h-2v5h2V7zm0 6h-2v2h2v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
