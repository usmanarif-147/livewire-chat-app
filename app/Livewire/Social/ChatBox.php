<?php

namespace App\Livewire\Social;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatBox extends Component
{
    public $userId = null;
    public $user = null;

    public $messageInput = 0;
    public $messageText = '';


    public function rules()
    {
        return [
            'messageText'  => ['required']
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    #[On('open-chat')]
    public function openChat($id)
    {
        $this->userId = $id;
        $this->user = User::where('id', $id)->first();
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

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->messageText = '';
    }

    public function render()
    {
        $loggedInUser = auth()->id();
        $connectionId = $this->userId;
        $chat = DB::table('chats')
            ->where(function ($query) use ($connectionId) {
                $query->where('sender_id', auth()->id())
                    ->where('reciever_id', $connectionId);
            })
            ->orWhere(function ($query) use ($connectionId) {
                $query->where('sender_id', $connectionId)
                    ->where('reciever_id', auth()->id());
            })
            ->get()
            ->map(function ($data) use ($loggedInUser) {
                return [
                    'message_id' => $data->id,
                    'sender_id' => $data->sender_id,
                    'reciever_id' => $data->reciever_id,
                    'message' => $data->message,
                    'created_at' => $data->created_at,
                    'sender' => $loggedInUser == $data->sender_id ? 1 : 0
                ];
            });

        return view('livewire.social.chat-box', [
            'connectionChat' => $chat
        ]);
    }
}
