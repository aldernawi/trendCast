<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report(Request $request, $postId)
    {
        $user = Auth::user();
    
        if ($user->user_type !== 'Client') {
            return response()->json(['message' => 'فقط العملاء يمكنهم الإبلاغ عن المنشورات.'], 403);
        }
    
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);
    
        Report::create([
            'user_id' => $user->id,
            'post_id' => $postId,
            'reason' => $request->input('reason'),
        ]);
    
        return response()->json(['message' => 'تم الإبلاغ بنجاح.']);
    }
    


    public function getReportedPosts()
    {
        
        $reports = Report::all();
        return view('admin.reports.index', compact('reports'));
    }
    public function destroy($id)
{
    $post = posts::findOrFail($id);
    
    if ($post->image && file_exists(public_path($post->image))) {
        unlink(public_path($post->image));
    }
    
    $post->delete();

    return redirect()->back()->with('success', 'تم حذف المنشور بنجاح');
}


}
