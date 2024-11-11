<?php

namespace App\Http\Controllers;

use App\Models\messege;
use App\Models\User;
use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Events\MessageSent;

class MessegeController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = messege::create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response(['status' => 'Message Sent!']);
    }

    public function index()
    {
        $users = \App\Models\User::where('id', '!=', auth()->id())->get();
        return view('messeges.index', compact('users'));
    }
}
