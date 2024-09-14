<?php

namespace App\Livewire\Social;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Chat extends Component
{

    public $selectedId = null;

    #[On('open-chat')]
    public function openChat($id)
    {
        $this->selectedId = $id;
    }

    public function render()
    {
        return view('livewire.social.chat');
    }
}
