<x-app-layout>

  <div class="card p-6 max-w-5xl mx-auto">
    <h1 class="text-3xl mb-10 text-center">{{ __('Create a new post') }}</h1>
    <div class="flex flex-col justify-center items-center w-full">

        {{-- Errors --}}
        @if ($errors->any())
            <div class="w-full bg-red-50 text-red-700 p-5 mb-5 rounded-xl">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form action="/p/create" method="POST" class="w-full" enctype="multipart/form-data">
      @csrf
      <x-create-edit-form />
      <x-primary-button class="mt-4">{{ __('Create Post') }}</x-primary-button>
    </form>
  </div>

</x-app-layout>
