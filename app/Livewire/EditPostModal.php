<?php

namespace App\Livewire;
use Illuminate\Support\Str;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;
class EditPostModal extends ModalComponent
{
    use WithFileUploads;

    public Post $post;
    public $newImage;
    public $description;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->description = $post->description;
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|string',
            'newImage' => 'nullable|image|max:1024', 
        ]);

        if ($this->newImage) {

            $imagePath = $this->newImage->store('temp');
            $post_image = 'posts/'.Str::random(30).'.jpg';
            Storage::move($imagePath, $post_image);
            $this->post->image = $post_image;
        }
        $this->post->description = $this->description;
        $this->post->save();

        session()->flash('message', 'Post updated successfully.');
        $this->dispatch('updated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.edit-post-modal');
    }
}
