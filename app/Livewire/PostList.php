<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
class PostList extends Component
{
    #[On(['unfollowUser', 'followUser','toggleFollow'])]
    public function getPostListProperty(){
        $ids = Auth::user()->following()->wherePivot('confirmed',true)->get()->pluck('id');
        return Post::whereIn('user_id',$ids)->latest()->get();
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
