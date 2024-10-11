<div class="w-full lg:w-[60%]">
    @forelse ($this->post_list as $post)
        <livewire:post :post="$post" :wire:key="'post_'.$post->id"/>
    @empty
        <div class="max-w-2xl mx-auto mt-5 text-center text-gray-700">
            {{ __('Start Following Your Friends and Enjoy') }}
        </div>
    @endforelse
</div>