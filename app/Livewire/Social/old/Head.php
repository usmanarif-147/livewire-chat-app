<?php

namespace App\Livewire\Social;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Head extends Component
{

    public $user = null;

    #[On('open-chat')]
    public function getHeadInfo($id)
    {
        $this->user = User::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.social.head');
    }
}
