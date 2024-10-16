<div class="card" :class="{'rtl': '{{ app()->getLocale() == 'ar' }}', 'ltr': '{{ app()->getLocale() == 'en' }}'}">
    <div class="card-header flex items-center">
        <img src="{{ $post->owner->image }}" class="w-9 h-9 rounded-full {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}">
        <a href="/{{ $post->owner->username }}" class="font-bold">{{ $post->owner->username }}</a>
    </div>

    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="storage/app/public/{{ $post->image }}" class="h-auto w-full object-cover" alt="{{ $post->description }}">
        </div>
        <div class="flex flex-row">
            <div class="p-3 flex items-center">
                <livewire:like :post="$post" />
                <a href="/p/{{ $post->slug }}" class="grow">
                    <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer {{ app()->getLocale() == 'ar' ? 'ml-3' : 'mr-3' }}"></i>
                </a>
            </div>
        </div>
        <div class="p-3">
            <a href="/{{ $post->owner->username }}" class="font-bold {{ app()->getLocale() == 'ar' ? 'ml-1' : 'mr-1' }}">{{ $post->owner->username }}</a>
            {{ $post->description }}
        </div>

        @if ($post->comments()->count() > 0)
            <a href="/p/{{ $post->slug }}" class="p-3 font-bold text-sm text-gray-500">
                {{ __('View all ') }} {{ $post->comments()->count() }} {{ __('comments') }}
            </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{ $post->created_at->diffForHumans() }}
        </div>
    </div>

    <div class="card-footer">
        <form action="/p/{{ $post->slug }}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" placeholder="{{ __('Add a comment ...') }}" autocomplete="off" autocorrect="off"
                    class="grow border-none resize-none focus:ring-0 outline-none bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400"></textarea>
                <button type="submit" class="bg-white border-none text-blue-500 {{ app()->getLocale() == 'ar' ? 'mr-5' : 'ml-5' }}">{{ __('POST') }}</button>
            </div>
        </form>
    </div>
</div>
