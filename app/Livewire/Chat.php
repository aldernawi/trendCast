<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $receiver_id;
    public $message;
    public $messages = [];
    public $users = [];

    public function mount()
    {
        $this->users = User::where('user_type', 'Company')
            ->orWhere('user_type', 'Freelancer')
            ->get();
        
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with('sender', 'receiver')
            ->get();
    }

    public function sendMessage()
{
    $this->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

$message = Message::create([
    'sender_id' => Auth::id(),
    'receiver_id' => $this->receiver_id,
    'message' => $this->message,
]);

    // Debugging
    dd($message);

    $this->message = ''; // Clear the message input
    $this->loadMessages(); // Reload messages
}

    public function render()
    {
        return view('livewire.messages');
    }
}
