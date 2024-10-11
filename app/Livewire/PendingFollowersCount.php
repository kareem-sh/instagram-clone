<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PendingFollowersCount extends Component
{
    protected $listeners = ['toggleFollow' => '$refresh','requestConfirmed' => '$refresh','requestDeleted' => '$refresh'];
    public function getCountProperty(){
        return Auth::user()->pending_followers()->count();
    }
    public function render()
    {
        return view('livewire.pending-followers-count');
    }
}
