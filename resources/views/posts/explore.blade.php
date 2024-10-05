<x-app-layout>
    <div class="grid grid-cols-3 gap-0 md:gap-5 mt-2">
        @foreach ($posts as $post)
            <div class="flex justify-center">
                <a href="/p/{{$post->slug}}">
                    <img class="w-70 h-70 object-cover" src="storage/app/public/{{$post->image}}" alt="{{ $post->title }}">
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-5 md-3">
        {{$posts->links()}}
    </div>
</x-app-layout>
