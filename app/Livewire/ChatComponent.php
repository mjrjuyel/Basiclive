<?php

namespace App\Livewire;

use Livewire\Component;

class ChatComponent extends Component
{
    public $user;
    public function render()
    {
        return view('livewire.chat-component');
    }

    public function mount($user){
        $this->user = $user;
    }
}
