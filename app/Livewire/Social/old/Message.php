<?php

namespace App\Livewire\Social;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{

    public $messageInput = 0;
    public $userId = null;
    public $messageText = '';

    protected function rules()
    {
        return [
            'messageText'  => ['required']
        ];
    }

    #[On('open-chat')]
    public function showMessageInput($id)
    {
        $this->userId = $id;
        $this->messageInput = 1;
    }

    public function sendMessage()
    {

        $this->validate();

        DB::table('chats')->insert([
            'sender_id' => auth()->id(),
            'reciever_id' => $this->userId,
            'message' => $this->messageText,
            'created_at' => now()
        ]);
    }

    public function render()
    {
        return view('livewire.social.message');
    }
}
