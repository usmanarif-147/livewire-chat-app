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
        $is_connected = DB::table('connections')
            ->where('sender_id', auth()->id())
            ->where('reciever_id', $id)
            ->exists();
        if (!$is_connected) {
            DB::table('connections')->insert([
                'sender_id' => auth()->id(),
                'reciever_id' => $id,
                'is_sender_connected' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $this->search = '';
        $this->selectedId = $id;
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
        $this->dispatch('open-chat', $id);
    }

    public function render()
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
            ->orWhere('connections.reciever_id', $loggedInUser)
            ->get()
            ->map(function ($data) use ($loggedInUser) {
                return [
                    'id' => $data->sender_id == $loggedInUser ? $data->reciever_id : $data->sender_id,
                    'name' => $data->sender_id == $loggedInUser ? $data->reciever_name : $data->sender_name,
                    'email' => $data->sender_id == $loggedInUser ? $data->reciever_email : $data->sender_email
                ];
            });

        return view('livewire.social.people', [
            'connections' => $connections
        ]);
    }
}
