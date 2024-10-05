
<input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl" type="file" name="image" id="file_input"">
<p class="mt-2 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or GIF</p>
<textarea name="description" class="mt-10 w-full border border-gray-200 rounded-xl" rows="5" placeholder="{{ __('Write a description') }}">{{$post->description ?? ""}}</textarea>