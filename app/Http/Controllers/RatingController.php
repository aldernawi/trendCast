<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function averageRating($serviceId)
    {
        $ratings = Rating::where('service_id', $serviceId)->get();
        $averageRating = $ratings->avg('rating');
        return $averageRating;
    }
    
    // Controller Method to Handle Rating Submission
    public function rateService(Request $request)
    {
        // افترض أن العملية تتم بنجاح
        Rating::create([
            'service_id' => $request->service_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
        ]);
    
        return redirect()->back()->with('success', 'تم إرسال تقييمك بنجاح');
    }
    
}
