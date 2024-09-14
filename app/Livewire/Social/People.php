<?php

namespace App\Livewire\Social;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class People extends Component
{
    public $search;

    public $searchList = [];

    public $selectedId = null;

    #[On('clear-search')]
    public function clearSearch()
    {
        $this->searchList = [];
    }

    public function makeConnection($id, $name)
    {
        $this->search = $name;
        $connection = DB::table('connections')
            ->where(function ($query) use ($id) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('sender_id', $id);
            })
            ->where(function ($query) use ($id) {
                $query->where('reciever_id', auth()->id())
                    ->orWhere('reciever_id', $id);
            })
            ->first();

        if ($connection && $connection->reciever_id == auth()->id() && !$connection->is_both_connected) {
            DB::table('connections')
                ->where('id', $connection->id)
                ->update([
                    'is_both_connected' => 1
                ]);
        }

        if (!$connection) {
            DB::table('connections')->insert([
                'sender_id' => auth()->id(),
                'reciever_id' => $id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->search = '';
        $this->selectedId = $id;
        $this->dispatch('open-chat', $id);
    }

    public function updatedSearch()
    {
        if (trim($this->search)) {
            $this->searchList = User::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
                ->where('id', '!=', auth()->id())
                ->get();
        } else {
            $this->searchList = [];
        }
    }

    public function openChat($id)
    {
        $this->selectedId = $id;
        DB::table('chats')->where('sender_id', $id)
            ->where('reciever_id', auth()->id())
            ->update([
                'is_read' => 1
            ]);
        $this->dispatch('open-chat', $id);
    }

    public function getUnreadMessages($id)
    {
        return DB::table('chats')
            ->where('sender_id', $id)
            ->where('reciever_id', auth()->id())
            ->where('is_read', 0)
            ->count();
    }

    public function getLastMessage($id)
    {
        return DB::table('chats')
            ->where(function ($query) use ($id) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('sender_id', $id);
            })
            ->where(function ($query) use ($id) {
                $query->where('reciever_id', auth()->id())
                    ->orWhere('reciever_id', $id);
            })
            ->orderBy('created_at', 'desc')
            ->first()
            ->message;
    }

    public function getConnections()
    {
        $loggedInUser = auth()->id();
        $connections = DB::table('connections')
            ->select(
                'connections.sender_id',
                'connections.reciever_id',
                'reciever.name as reciever_name',
                'reciever.email as reciever_email',
                'sender.name as sender_name',
                'sender.email as sender_email'
            )
            ->join('users as sender', 'sender.id', 'connections.sender_id')
            ->join('users as reciever', 'reciever.id', 'connections.reciever_id')
            ->where('connections.sender_id', $loggedInUser)
            ->orWhere(function ($query) use ($loggedInUser) {
                $query->where('connections.reciever_id', $loggedInUser)
                    ->where('is_both_connected', 1);
            })
            ->get()
            ->map(function ($data) use ($loggedInUser) {

                $id = $data->sender_id == $loggedInUser ? $data->reciever_id : $data->sender_id;
                $name = $data->sender_id == $loggedInUser ? $data->reciever_name : $data->sender_name;
                $email = $data->sender_id == $loggedInUser ? $data->reciever_email : $data->sender_email;
                $unread = $this->getUnreadMessages($id);
                $last_message = $this->getLastMessage($id);
                return [
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'unread' => $unread,
                    'last_message' => $last_message
                ];
            });

        return $connections->sortByDesc('unread')->values();
    }

    public function render()
    {

        $connections = $this->getConnections();

        return view('livewire.social.people', [
            'connections' => $connections
        ]);
    }
}
