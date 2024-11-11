<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function fetchComments($postId)
    {
        $post = posts::with('comments.user')->find($postId);
        return response()->json([
            'comments' => $post->comments,
        ]);
    }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);
    
        // حاول إنشاء التعليق
        try {
            $comment = Comment::create([
                'post_id' => $postId,
                'user_id' => auth()->id(),
                'comment' => $request->input('comment'),
            ]);
    
            // أرجع استجابة JSON بنجاح
            return response()->json(['success' => true, 'message' => 'تم اضافة التعليق بنجاح.']);
        } catch (\Exception $e) {
            // في حال حدوث خطأ، أرجع استجابة JSON بالفشل
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء إضافة التعليق.']);
        }
    }
    


    public function update(Request $request, $id)
{
    $comment = Comment::find($id);
    if ($comment && $comment->user_id == auth()->id()) { // Verify the user owns the comment
        $comment->update([
            'comment' => $request->input('comment'),
        ]);
        return response()->json(['success' => 'تم تحديث التعليق بنجاح']);
    }
    return response()->json(['success' => 'تعليق غير موجود'], 403);
}


public function destroy($id)
{
    $comment = Comment::find($id);

    if (!$comment) {
        return response()->json(['error' => 'التعليق غير موجود'], 404);
    }

    $comment->delete();

    return response()->json(['success' => 'تم حذف التعليق بنجاح']);
}

}
