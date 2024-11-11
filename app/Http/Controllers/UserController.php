<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type', 'Company')->get();
        return view('admin.users.companies', compact('users'));
    }
    public function index1()
    {
        $users = User::where('user_type', 'Freelancer')->get();
        return view('admin.users.freelancers', compact('users'));
    }
    public function index2()
    {
        $users = User::where('user_type', 'Client')->get();
        return view('admin.users.clients', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
       /* $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'user_type' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'company_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'location' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpg,jpeg,png',
            'cover_image' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }*/
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
            'status' => $request->status,
            'company_url' => $request->company_url,
            'facebook_url' => $request->facebook_url,
            'linkedin_url' => $request->linkedin_url,
            'instagram_url' => $request->instagram_url,
            'twitter_url' => $request->twitter_url,
            'location' => $request->location,
        ];
        
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile-images'), $imageName);
            $data['image'] = $imageName;
        }
        
        $user = User::create($data);
        
        if($user->user_type == 'Company'){
            return redirect()->route('users.companies')->with('success', 'تم اضافة الشركة بنجاح.');
        }
        elseif($user->user_type == 'Freelancer'){
            return redirect()->route('users.freelancers')->with('success', 'تم اضافة المستقل بنجاح.');
        }
        elseif($user->user_type == 'Client'){
            return redirect()->route('users.clients')->with('success', 'تم اضافة العميل بنجاح.');
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
       /* $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'user_type' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
            'company_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'location' => 'nullable|string|max:255',
        ]);
*/
$data = [
    'name' => $request->name,
    'email' => $request->email,
    'user_type' => $request->user_type,
    'password' => Hash::make($request->password),
    'phone' => $request->phone,
    'address' => $request->address,
    'description' => $request->description,
    'status' => $request->status,
    'company_url' => $request->company_url,
    'facebook_url' => $request->facebook_url,
    'linkedin_url' => $request->linkedin_url,
    'instagram_url' => $request->instagram_url,
    'twitter_url' => $request->twitter_url,
    'location' => $request->location,
];

if (!empty($request->file('image'))) {
    $image = $request->file('image');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('profile-images'), $imageName);
    $data['image'] = $imageName;
}


// Hash and update password only if provided
if(!empty($request->password)) {
    $password = Hash::make($request->password);
    $data['password'] = $password;
}

$user = User::find($id);
$user->update($data);

// Redirect based on user type
if($user->user_type == 'Company'){
    return redirect()->route('users.companies')->with('success', 'تم تحديث الشركة بنجاح.');
} elseif($user->user_type == 'Freelancer'){
    return redirect()->route('users.freelancers')->with('success', 'تم تحديث المستقل بنجاح.');
} elseif($user->user_type == 'Client'){
    return redirect()->route('users.clients')->with('success', 'تم تحديث العميل بنجاح.');
}

    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        if($user->user_type == 'Company'){
            return redirect()->route('users.companies')->with('success', 'تم حذف الشركة بنجاح.');
        } elseif($user->user_type == 'Freelancer'){
            return redirect()->route('users.freelancers')->with('success', 'تم حذف المستقل بنجاح.');
        } elseif($user->user_type == 'Client'){
            return redirect()->route('users.clients')->with('success', 'تم حذف العميل بنجاح.');
        }
       }
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->user_type == 'Company') {
            $user->status = $request->input('status');
            $user->save();
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 400);
    }
    
}