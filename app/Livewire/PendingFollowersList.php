<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Component;

class PendingFollowersList extends Component
{
    protected $follower;

    protected $listeners = ['toggleFollow' => '$refresh','requestConfirmed' => '$refresh','requestDeleted' => '$refresh'];

    public function confirm($id){
        $this->follower = User::find($id);
        Auth::user()->confirm($this->follower);
        $this->dispatch('requestConfirmed');
    }

    public function delete($id){
        $this->follower = User::find($id);
        Auth::user()->deleteFollowRequest($this->follower);
        $this->dispatch('requestDeleted');
    }
    public function render()
    {
        return view('livewire.pending-followers-list');
    }
}
