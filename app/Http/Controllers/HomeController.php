<?php

namespace App\Http\Controllers;
Use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User_service_details;
use App\Models\posts;
use App\Models\User;
use App\Models\Bookings;
use App\Models\Comment;
use App\Models\notice;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if(auth::id())
        {
            if(auth::user()->user_type === 'Admin')
            {
                $users=User::count();
                $companies= User::where('user_type', 'Company')->count();
                $freelancers= User::where('user_type', 'Freelancer')->count();
                $Clients= User::where('user_type', 'Client')->count();
                $services=Service::count();

                return view('admin.app', compact('users','companies','freelancers','services','Clients'));
               
            }
            elseif(auth::user()->user_type === 'Company')
            {
                $company_id = auth::user()->id; 
                $newBookingsCount = Bookings::where('company_id', $company_id)
                ->where('status', 'Pending') // أو أي شرط يناسب تعريفك للحجوزات الجديدة
                ->count();

                $Accepted = Bookings::where('company_id', $company_id)
                ->where('status', 'Accepted') // أو أي شرط يناسب تعريفك للحجوزات الجديدة
                ->count();


                $Rejected = Bookings::where('company_id', $company_id)
                ->where('status', 'Rejected') // أو أي شرط يناسب تعريفك للحجوزات الجديدة
                ->count();
                $bookings=Bookings::where('company_id', $company_id)->count();

                $services = User_service_details::where('user_id', $company_id)->count();
                $posts = posts::with('comments')->where('user_id', $company_id)->count();

                $postnns = posts::where('user_id', $company_id)->count();

                return view('company.app', compact('newBookingsCount','Accepted','Rejected','bookings','services','posts'));
            }
            else if(auth::user()->user_type === 'Freelancer')
            {
                $freelancer_id = auth::user()->id; 
                $services = User_service_details::where('user_id', $freelancer_id)->count();
                $posts = posts::where('user_id', $freelancer_id)->count();
                return view('freelancer.app', compact('services','posts'));
            }
            else
            {
                $users=User::where('user_type', 'Company')
                ->orWhere('user_type', 'Freelancer')
                ->get();
            
            
                $addresses=User::select('address')->distinct()->get();
                $services=Service::select('name')->distinct()->get();
              // الحصول على الإشعارات غير المقروءة للمستخدم
              $notifications = auth()->user()->notifications; // قراءة الإشعارات فقط، لا تقوم بتحديثها هنا

              $unreadNotifications = Notice::where('user_id', Auth::id())
              ->where('is_read', false)
              ->get();
              
// تحديث حالة جميع الإشعارات إلى "مقروءة"
Notice::where('user_id', Auth::id())
->where('is_read', false)
->update(['is_read' => true]);


                return view('website.home', compact('notifications','users','addresses','services'));
            }
        }
    }

public function main()
{
    $users=User::where('user_type', 'Company')
    ->orWhere('user_type', 'Freelancer')
    ->get();


    $addresses=User::select('address')->distinct()->get();
    $services=Service::select('name')->distinct()->get();
    return view('website.home', compact('users','addresses','services'));
}

public function services($id)
{
    $users=User::where('id', $id)->first();
    $posts = posts::with('images')->where('user_id', $id)->get();
    $usersServices = user_service_details::where('user_id', $id)->get();
    return view('website.users', compact('usersServices', 'posts', 'users'));
}

public function posts($id)
{
    $users=User::where('id', $id)->first();
    $posts = posts::with('images')->findOrFail($id);
    
    $comments = Comment::with('user')->where('post_id', $id)->get();
    return view('website.post', compact('posts', 'users','comments'));
}

public function allUsers(Request $request)
{
   
        $users = User::where('user_type', 'Company')
                     ->orWhere('user_type', 'Freelancer')
                     ->get();
    
        $address = $request->input('address');
        $priceRange = $request->input('price');
        $serviceName = $request->input('service');
    
        $query = DB::table('users')
            ->join('user_service_details', 'users.id', '=', 'user_service_details.user_id')
            ->join('services', 'user_service_details.service_id', '=', 'services.id')
            ->when($serviceName, function ($query, $serviceName) {
                $query->where('services.name', 'LIKE', '%' . $serviceName . '%');
            })
            ->when($address, function ($query, $address) {
                $query->where('users.address', '=', $address);
            })
            ->when($priceRange == 'under-400', function ($query) {
                $query->where('user_service_details.price', '<=', 400);
            })
            ->when($priceRange == 'under-1000', function ($query) {
                $query->where('user_service_details.price', '<=', 1000);
            })
            ->when($priceRange == 'above-1000', function ($query) {
                $query->where('user_service_details.price', '>=', 1000);
            })
            ->select(
                'users.id as user_id',
                'user_service_details.id as user_service_detail_id', 
                'users.name', 
                'users.address', 
                'user_service_details.price', 
                'services.name as service_name'
            )
            ->get();
    
        
    
        return view('website.explore', compact('query', 'users'));
    }
    
    public function search(Request $request)
    {
        $users = User::where('user_type', 'Company')
                     ->orWhere('user_type', 'Freelancer')
                     ->get();
    
        $address = $request->input('address');
        $priceRange = $request->input('price');
        $serviceName = $request->input('service');
    
        $query = DB::table('users')
            ->join('user_service_details', 'users.id', '=', 'user_service_details.user_id')
            ->join('services', 'user_service_details.service_id', '=', 'services.id')
            ->when($serviceName, function ($query, $serviceName) {
                $query->where('services.name', 'LIKE', '%' . $serviceName . '%');
            })
            ->when($address, function ($query, $address) {
                $query->where('users.address', '=', $address);
            })
            ->when($priceRange == 'under-400', function ($query) {
                $query->where('user_service_details.price', '<=', 400);
            })
            ->when($priceRange == 'under-1000', function ($query) {
                $query->where('user_service_details.price', '<=', 1000);
            })
            ->when($priceRange == 'above-1000', function ($query) {
                $query->where('user_service_details.price', '>=', 1000);
            })
            ->select(
                'users.id as user_id',
                'user_service_details.id as user_service_detail_id', 
                'users.name', 
                'users.address', 
                'user_service_details.price', 
                'services.name as service_name'
            )
            ->get();
    
        // طباعة الكويري للتحقق من البيانات
        
    
        return view('website.result', compact('query', 'users'));
    }
    




//التقرير العام للشركة
public function reports()
{
    $users = User::where(function($query) {
        $query->where('user_type', 'Company')
              ->orWhere('user_type', 'Freelancer');
    })->where('status', 'active')->get();

    $services = [];
    $posts = [];
    $bookings = [];

    foreach ($users as $user) {
        $services[$user->id] = user_service_details::where('user_id', $user->id)->count();
        $posts[$user->id] = posts::where('user_id', $user->id)->count();
        $bookings[$user->id] = bookings::where('company_id', $user->id)->distinct()->count();
    }

    return view('admin.report.index', compact('users', 'services', 'posts', 'bookings'));
}



//تقرير الشركات
    public function companyReport()
    {
        // جلب الخدمات التي تقدمها الشركة المحددة

        $companyId = auth()->user()->id;
        $services = user_service_details::where('user_id', $companyId)
            ->with(['booking', 'ratings'])
            ->get();

        return view('company.report.index', compact('services'));
    }
}


