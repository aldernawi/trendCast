<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
    
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
    
                // تحقق من حالة المستخدم
                if ($user->status === 'inactive') {
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['error' => 'حسابك غير مفعل.']);
                }
    
                // تحقق من نوع المستخدم وإعادة توجيه حسب النوع
                if ($user->user_type === 'Company') {
                    return redirect('/home');
                } elseif ($user->user_type === 'Freelancer') {
                    return redirect('/home');
                } else {
                    return redirect('/home');
                }
            }
        }
    
        return $next($request);
    }
    
}

