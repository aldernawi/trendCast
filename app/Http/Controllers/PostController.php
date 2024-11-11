<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\postImages;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use app\Models\Comment;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $posts = posts::with('user')->where('user_id', Auth::id())->get();
        return view('company.posts.index', compact('posts', 'user'));
    }


    public function store(Request $request)
    {
       $data=$request->only('title','description','user_id');
       $data['user_id']=Auth::id();
       $data=posts::create($data);

       if (!empty($request->file('images'))) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post-images'), $imageName);
            $data->images()->create([
                'path' => $imageName,
                'post_id' => $data->id
            ]);
        }
    }

        return redirect()->route('posts.index')->with('success', 'تم نشر المنشور بنجاح');
    }

  
   
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'nullable', // تحديد أنواع الفيديو وصيغها
            'images.*' => 'nullable', // تحديد أنواع وصيغ الصور
        ]);
    
        // العثور على المنشور الذي سيتم تحديثه
        $post = posts::findOrFail($id);
    
        // تحديث بيانات المنشور
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        
        // معالجة الفيديو إذا تم رفعه
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = uniqid() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('post-videos'), $videoName);
            $post->video = 'post-videos/' . $videoName;
        }
    
        // حفظ التحديثات في قاعدة البيانات
        $post->save();
    
        // معالجة الصور إذا كانت موجودة
        if ($request->hasFile('images')) {
            // حذف الصور السابقة
            $post->images()->delete();
            
            foreach ($request->file('images') as $image) {
                $imageName = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('post-images'), $imageName);
                $post->images()->create([
                    'path' =>$imageName,
                    'post_id' => $post->id
                ]);
            }
        }
    
        return redirect()->route('posts.index')->with('success', 'تم تحديث المنشور بنجاح!');
    }
    
    public function destroy($id)
    {
        $post = posts::find($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم حذف المنشور بنجاح');
    }


    public function getComments($postId)
    {
        $post = posts::with('comments.user')->findOrFail($postId);
        return response()->json([
            'comments' => $post->comments
        ]);
    }
    
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        $user = auth()->user();
    
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $postId;
        $comment->comment = $request->comment;
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    




//freelancer posts

public function main()
{
    $user = User::where('id', Auth::id())->first();
    $posts = posts::with('user')->where('user_id', Auth::id())->get();
    return view('freelancer.posts.index', compact('posts', 'user'));
}
    public function save (Request $request)
    {
   
        $video = $request->file('video');
        if ($video) {
            $videoName = time() . '.' . $video->getClientOriginalExtension(); // تأكد من إضافة النقطة بين الوقت وامتداد الملف
            $video->move(public_path('post-videos'), $videoName);
            $data['video'] = $videoName;
        }
        

       $data=$request->only('title','description','user_id','video');
       $data['user_id']=Auth::id();
       $data=posts::create($data);

       if (!empty($request->file('images'))) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post-images'), $imageName);
            $data->images()->create([
                'path' => $imageName,
                'post_id' => $data->id
            ]);
        }
    }
    return redirect()->route('posts')->with('success', 'تم نشر المنشور بنجاح');
    }

    public function update2(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'nullable|mimes:mp4,avi,mov|max:20000', // تحديد أنواع الفيديو وصيغها
            'images.*' => 'nullable'
        ]);
    
        // العثور على المنشور الذي سيتم تحديثه
        $post = posts::findOrFail($id);
    
        // تحديث بيانات المنشور
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        
     
        // حفظ التحديثات في قاعدة البيانات
        $post->save();
    
        // معالجة الصور إذا كانت موجودة
        if ($request->hasFile('images')) {
            // حذف الصور السابقة
            $post->images()->delete();
            
            foreach ($request->file('images') as $image) {
                $imageName = time() . '.' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('post-images'), $imageName);
                $post->images()->create([
                    'path' =>$imageName,
                    'post_id' => $post->id
                ]);
            }
        }
    
        return redirect()->route('posts')->with('success', 'تم تحديث المنشور بنجاح!');
    }
    public function delete($id)
    {
        $post = posts::find($id);
        $post->delete();
        return redirect()->route('posts')->with('success', 'تم حذف المنشور بنجاح');
    }
}
