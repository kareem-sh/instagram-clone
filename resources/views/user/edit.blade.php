<x-app-layout>
    <div class="container mb-8">

        <form action="/{{$user->username}}/update" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="space-y-12">
                <!-- Profile Section -->
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly, so be careful what you share.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <input type="text" name="username" id="username" autocomplete="username" class="block rounded-md flex-1 border-0 py-1.5 pl-3 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6" value="{{$user->username }}">
                                </div>
                                @error('username')
                                    <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                                @enderror
                            </div>                            
                        </div>

                        <!-- Account Status Section -->
                        <div class="sm:col-span-4">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Account Status</label>
                            <div class="mt-2 flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="radio" id="status_public" name="status" value="public" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" {{$user->private_account == 0 ? 'checked' : '' }}>
                                    <label for="status_public" class="ml-2 block text-sm text-gray-900">Public</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" id="status_private" name="status" value="private" class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" {{ $user->private_account == 1 ? 'checked' : '' }}>
                                    <label for="status_private" class="ml-2 block text-sm text-gray-900">Private</label>
                                </div>
                                @error('Account Status')
                                <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                            @enderror
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Bio</label>
                            <div class="mt-2">
                                <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $user->bio }}</textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                            @error('bio')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900">Profile Photo</label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <img src="{{$user->image }}" class="h-12 w-12 rounded-full">
                                <input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl" type="file" name="image" id="file_input">
                            </div>
                            @error('image')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                            <div class="mt-2">
                                <input value="{{ $user->name }}" type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email Address</label>
                            <div class="mt-2">
                                <input value="{{ $user->email }}" id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('email')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Security</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Ensure your account is secure with a strong password.</p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="Current_password" class="block text-sm font-medium leading-6 text-gray-900">Current Password</label>
                            <div class="mt-2">
                                <input type="password" name="current-password" id="Current_password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('current-password')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>

                        <div class="sm:col-span-4">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('password')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>

                        <div class="sm:col-span-4">
                            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            @error('password_confirmation')
                            <div class="mt-2 text-sm text-red-600">{{$message}}</div>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
