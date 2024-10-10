<?php
namespace App\Livewire;

    use Livewire\Component;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    class Followbutton extends Component
    {
        public $classes;
        public $classes2;
        public $userId;
        protected $user;
        public $follow_state;

        public function mount(){
            $this->user = User::find($this->userId);
            $this->set_follow_state();
        }

        public function toggle_follow(){
            $this->user = User::find($this->userId);
            Auth::user()->toggle_follow($this->user);
            $this->set_follow_state();
        }

        public function set_follow_state(){
            if(Auth::user()->is_pending($this->user)){
                $this->follow_state = "Pending";
            }else if(Auth::user()->is_following($this->user)){
                $this->follow_state = "Unfollow";
            }else{
                $this->follow_state = "Follow";
            }
        }

        public function render()
        {
            return view('livewire.follow-button');
        }
    }
