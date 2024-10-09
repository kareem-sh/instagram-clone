<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class Like extends Component
{
    public $post;

    public function toggle_like()
    {
        // Toggle the like for the post
        Auth::user()->likes()->toggle($this->post);

        // Emit an event after the like is toggled
        $this->dispatch('likeToggled');
    }

    public function render()
    {
        return view('livewire.like');
    }
}
