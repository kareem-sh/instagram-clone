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
                        <img src="{{ asset($post->owner->image) }}" alt="{{ $post->owner->username }}"
                            class="mr-3 h-10 w-10 rounded-full">
                        <div class="grow">
                            <a href="/{{ $post->owner->username }}"
                                class="font-bold text-gray-800">{{ $post->owner->username }}</a>
                        </div>
                        @can('update',$post)
                            <a href="/p/{{ $post->slug }}/edit"><i class="bx bx-message-square-edit text-xl"></i></a>


                            <form action="/p/{{ $post->slug }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">
                                    <i class="bx bx-message-square-x ml-2 text-xl text-red-600"></i>
                                </button>
                            </form>
                        @endcan

                        @cannot('update',$post)
                           <livewire:follow-button  :userId="$post->owner->id" :classes="'text-blue-500'" :classes2="'text-gray-500'" />
                        @endcannot
                    </div>
                </div>

                {{-- Post Description --}}
                <div class="border-b border-gray-300 pb-3 mb-3">
                    <div class="flex items-center">
                        <img src="{{ asset($post->owner->image) }}" alt="{{ $post->owner->username }}"
                            class="mr-3 h-10 w-10 rounded-full">
                        <a href="/{{ $post->owner->username }}"
                            class="font-bold text-gray-800">{{ $post->owner->username }}</a>
                        <span class="ml-2 text-gray-500">{{ $post->description }}</span>
                    </div>
                </div>

                {{-- Comments Section (Immediately below the username line) --}}
                <div class="flex-1 overflow-auto">
                    <div class="space-y-2">
                        {{-- Loop through comments --}}
                        @foreach ($post->comments as $comment)
                            <div class="flex items-start  py-2">
                                <img src="{{ asset($comment->owner->image) }}" alt="{{ $comment->owner->username }}"
                                    class="h-100 mr-5 w-10 rounded-full">
                                <div class="flex flex-col">
                                    <div>
                                        <a href="/{{ $comment->owner->username }}"
                                            class="font-bold">{{ $comment->owner->username }}</a>
                                        <span class="ml-2 text-gray-500">{{ $comment->body }}</span>
                                    </div>
                                    <div class="text-sm font-bold text-gray-400">
                                        {{ $comment->created_at->diffForHumans(null, true, true) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                 
                {{-- Interaction Buttons --}}
                <div class="p-3 border-t">
                    <div class="flex justify-between items-center">
                        <livewire:like :post="$post"/>
                        <a class="grow" onclick="document.getElementById('comment_body').focus()">
                            <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
                        </a>
                        
                    </div>
                </div>
                <livewire:likedby :post="$post" />
                {{-- Comment Input Section --}}
                <div class="border-t pt-3">
                    <form action="/p/{{ $post->slug }}/comment" method="POST">
                        @csrf
                        <div class="flex flex-row">
                            <textarea name="body" id="comment_body" placeholder="Add a comment..."
                                class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-none focus:ring-0"
                                rows="3"></textarea>
                            <button type="submit" class="ml-5 border-none bg-white text-blue-500">Post</button>
                        </div>
                    </form>
                </div>
                

               
               
            </div>
        </div>
    </div>
</x-app-layout>
