<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Messages extends Component
{
    public $messages = [];
    public $users = [];
    public $selectedReceiverId;

    public function mount()
    {
        // استرجاع قائمة المستخدمين عند تحميل الصفحة
        $this->users = User::all();
        $this->updateMessages();
    }

    public function updatedSelectedReceiverId($receiverId)
    {
        // تحديث الرسائل عند تغيير المرسل إليه
        $this->updateMessages();
    }

    public function updateMessages()
    {
        // فلترة الرسائل بناءً على المرسل إليه
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
