<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من وجود العنصر في المفضلة
        $exists = Favorite::where('user_id', $request->user()->id)
                           ->where('favoritable_id', $request->favoritable_id)
                           ->where('favoritable_type', $request->favoritable_type)
                           ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'exists', 
                'message' => 'Already in favorites'
            ], 200); // تعديل الحالة هنا لتكون 200 بدلاً من 400 حتى تعمل بشكل صحيح مع الجافاسكريبت
        }

        // إضافة العنصر إلى المفضلة
        Favorite::create([
            'user_id' => $request->user()->id,
            'favoritable_id' => $request->favoritable_id,
            'favoritable_type' => $request->favoritable_type,
        ]);

        return response()->json([
            'status' => 'added', 
            'message' => 'Added to favorites'
        ], 200);
    }

    public function index()
    {
        // عرض المفضلات
        $favorites = Favorite::where('user_id', auth()->id())->get();

        return view('website.favorites', compact('favorites'));
    }

    public function destroy($id)
    {
        try {
            $favorite = Favorite::where('id', $id)
                                ->where('user_id', auth()->id())
                                ->firstOrFail();
    
            $favorite->delete();
    
            return redirect()->route('favorites.index')->with('success', 'تمت إزالة المفضلة بنجاح.');
        } catch (\Exception $e) {
            return redirect()->route('favorites.index')->with('error', 'حدث خطأ! حاول مرة أخرى.');
        }
    }
}
