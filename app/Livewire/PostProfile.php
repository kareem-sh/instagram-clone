<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostProfile extends Component
{
    public $userId;
    protected $user;

    public function mount()
    {
        $this->user = User::find($this->userId);
    }

    #[On('updated')]
    public function getPostsProperty()
    {
        $this->user = User::find($this->userId); // Get user by $this->userId to ensure it's correct
        return $this->user->posts;
    }

    #[On('createPost')]
    public function refreshPosts()
    {
        $this->user = User::find($this->userId); // Refresh user data to get latest posts
    }

    public function render()
    {
        return view('livewire.post-profile');
    }
}
