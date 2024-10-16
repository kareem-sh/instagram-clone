<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class Search extends Component
{
    public $searchInput = '';
    public $results = [];

    public function clear()
    {
        // Reset the search input and results
        $this->searchInput = '';
        $this->reset('searchInput');
        $this->results = [];
    }
    public function goto($username){
        return redirect()->route('user_profile',['user'=>$username]);
    }
    public function render()
    {
        // Perform search if there's input
        if (!empty($this->searchInput)) {
            $this->results = User::where('username', 'LIKE', '%' . $this->searchInput . '%')
                ->take(10) // Limit to 10 results
                ->get(['id', 'name', 'username', 'image']);
        } else {
            $this->results = [];
        }

        return view('livewire.search', [
            'results' => $this->results
        ]);
    }
}
