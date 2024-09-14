<?php

namespace App\Livewire\Social;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Body extends Component
{

    public $messages = [];

    #[On('open-chat')]
    public function getUserMessages($id)
    {
        $this->messages = DB::table('chats')
            ->where('sender_id', auth()->id())
            ->where('reciever_id', $id)
            ->get();
    }

    public function render()
    {
        return view('livewire.social.body');
    }
}
