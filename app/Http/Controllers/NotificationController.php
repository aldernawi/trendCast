<?php

namespace App\Http\Controllers;

use App\Models\notice;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * عرض جميع الإشعارات للمستخدم.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = auth()->user()->notifications;

        // تحديث حالة الإشعارات إلى "مقروءة" عند عرضها
        foreach ($notifications as $notification) {
            if (!$notification->is_read) {
                $notification->is_read = true;
                $notification->save();
            }
        }

        return view('home', compact('notifications')); // استبدل 'home' باسم العرض الذي تستخدمه
    }

    /**
     * تحديث حالة الإشعار إلى "مقروء".
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request)
    {
        $notificationId = $request->notification_id;
        
        // العثور على الإشعار بناءً على المعرف والمستخدم
        $notification = Notice::where('user_id', Auth::id())
                              ->where('id', $notificationId)
                              ->first();
        
        if ($notification) {
            // تحديث حالة الإشعار إلى مقروء
            $notification->is_read = true;
            $notification->save();
            return response()->json(['status' => 'success']);
        }
    
        return response()->json(['status' => 'error'], 404);
    }

    /**
     * تحديث حالة جميع الإشعارات إلى "مقروءة".
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead()
    {
        $userId = auth()->id();
        $unreadNotifications = Notice::where('user_id', $userId)
                                     ->where('is_read', false)
                                     ->get();
   
        // تحديث حالة جميع الإشعارات إلى "مقروءة"
        Notice::where('user_id', $userId)
              ->where('is_read', false)
              ->update(['is_read' => true]);
    
        return response()->json([
            'status' => 'success',
            'unread_count' => $unreadNotifications->count()
        ]);
    }
    
    
}

