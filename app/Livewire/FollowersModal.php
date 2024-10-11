<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;

class FollowersModal extends ModalComponent
{
    public $userId;

    protected $user;
    protected $follow_state;
    public function getFollowersListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed',true)->get();
    }
   
    public function toggle_follow($userId){
        $following_user = User::find($userId);
        $this->user = User::find($this->userId);
        $this->user ->toggle_follow($following_user);
        $this->dispatch('followUser');
        $this->dispatch('refreshPosts'); 
    }


    public function render()
    {
        return view('livewire.followers-modal');
    }
}
