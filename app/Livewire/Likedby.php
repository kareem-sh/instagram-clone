<?php

namespace App\Livewire;
use Livewire\Attributes\On;
use Livewire\Component;

class Likedby extends Component
{
    public $post;

    
    #[On('likeToggled')] 
    public function getLikesProperty(){
        return $this->post->likes()->count();
    }

    public function getFirstusernameProperty(){
        return $this->post->likes()->first()->username;
    }
    public function render()
    {
        return view('livewire.likedby');
    }
}
