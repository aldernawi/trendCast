<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
  
    public function index(Request $request)
    {
        // جلب الشركات والفريلانسرز فقط
        $companiesAndFreelancers = User::where('user_type', 'Company')
            ->orWhere('user_type', 'Freelancer')
            ->get();
    
        // جلب العملاء فقط
        $clients = User::where('user_type', 'Client')->get();
    
        // الحصول على الشخص الذي يتم التواصل معه
        $selectedUserId = $request->input('user_id');
    
        // جلب الرسائل مع الشخص المحدد فقط
        $messages = Message::where(function ($query) use ($selectedUserId) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $selectedUserId);
            })
            ->orWhere(function ($query) use ($selectedUserId) {
                $query->where('receiver_id', Auth::id())
                    ->where('sender_id', $selectedUserId);
            })
            ->with('sender', 'receiver')
            ->get();
    
        return view('messeges.index', compact('companiesAndFreelancers', 'clients', 'messages', 'selectedUserId'));
    }
    


    public function store(Request $request)
    {
        $originalMessageId = $request->input('original_message_id');
        
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'original_message_id' => $originalMessageId,
        ]);

        return redirect()->route('messages.index', ['user_id' => $request->receiver_id])
            ->with('success', 'تم إرسال الرسالة بنجاح');
    }
}
