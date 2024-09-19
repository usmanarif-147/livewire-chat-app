<?php

namespace App\Livewire\Social;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChatBox extends Component
{
    public $userId = null;
    public $user = null;

    public $messageInput = 0;
    public $messageText = '';
    public $connectionChat = [];


    public function mount($id)
    {
        $this->userId = $id;
        $this->loadChatData();
        $this->dispatch('chat-box-rendered');
    }

    public function updatedUserId($value)
    {
        $this->loadChatData();
    }

    public function loadChatData()
    {
        $this->user = User::find($this->userId);
        $this->messageInput = 1;
        $this->getConnectionChat();
    }

    public function sendMessage()
    {
        $this->validate([
            'messageText' => ['required']
        ]);

        $messages = DB::table('chats')
            ->where('sender_id', auth()->id())
            ->where('reciever_id', $this->userId)
            ->get();
        if (!$messages->count()) {
            DB::table('connections')
                ->where('sender_id', auth()->id())
                ->where('reciever_id', $this->userId)
                ->update([
                    'is_both_connected' => 1
                ]);
        }
        DB::table('chats')->insert([
            'sender_id' => auth()->id(),
            'reciever_id' => $this->userId,
            'message' => $this->messageText,
            'created_at' => now()
        ]);

        $this->getConnectionChat();

        $this->resetForm();
        $this->dispatch('chat-box-rendered');
    }

    public function resetForm()
    {
        $this->messageText = '';
    }

    public function getConnectionChat()
    {
        $loggedInUser = auth()->id();
        $connectionId = $this->userId;
        $this->connectionChat = DB::table('chats')
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
    }

    public function render()
    {
        return view('livewire.social.chat-box');
    }
}
