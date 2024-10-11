<?php

namespace App\Livewire;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
class Followers extends Component
{
    public $userId;
    protected $user;

    #[On(['unfollowUser', 'followUser'])]
    public function getCountProperty(){
        $this->user = User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed', true)->count();
    }
    public function render()
    {
        return view('livewire.followers');
    }
}
