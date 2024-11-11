<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessagesComponent extends Component
{
    public $messages = [];
    public $users = [];
    public $selectedReceiverId;

    public function mount()
    {
        $this->users = User::all();
        $this->updateMessages();
    }

    public function updatedSelectedReceiverId($receiverId)
    {
        $this->updateMessages();
    }

    public function updateMessages()
    {
        if ($this->selectedReceiverId) {
            $this->messages = Message::where(function ($query) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $this->selectedReceiverId)
                      ->orWhere('receiver_id', Auth::id())
                      ->where('sender_id', $this->selectedReceiverId);
            })->get();
        } else {
            $this->messages = [];
        }
    }

    public function render()
    {
        return view('livewire.messages-component');
    }
}
