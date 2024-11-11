<?php

namespace App\Http\Controllers;

use App\Models\user_service_details;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SubService;

class UserServiceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $services = Service::all();
        $subServices = SubService::all();
        $userServices = user_service_details::where('user_id', $user->id)->get();
        return view('company.services.index', compact('userServices', 'user', 'services', 'subServices'));
    }

    public function create()
    {
        return view('company.user_services.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
      
        user_service_details::create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'sub_service_id' => $request->sub_service_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('user_services.index')->with('success', 'تمت إضافة الخدمة بنجاح');

}

    public function edit(user_service_details $userService)
    {
        return view('company.user_services.edit', compact('userService'));
    }

    public function update(Request $request, user_service_details $userService)
    {
        $user = auth()->user();

        user_service_details::where('id', $userService->id)->update([
            'service_id' => $request->service_id,
            'sub_service_id' => $request->sub_service_id,
            'user_id' =>$user->id,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('user_services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(user_service_details $userService)
    {
        $userService->delete();
        return redirect()->route('user_services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }









    //freelancer
    public function main()
    {
        $user = auth()->user();
        $services = Service::all();
        $subServices = SubService::all();
        $userServices = user_service_details::where('user_id', $user->id)->get();
        return view('freelancer.services.index', compact('userServices', 'user', 'services', 'subServices'));
    }

    public function save(Request $request)
    {
        $user = auth()->user();
      
        user_service_details::create([
            'user_id' => $user->id,
            'service_id' => $request->service_id,
            'sub_service_id' => $request->sub_service_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('user_services')->with('success', 'تمت إضافة الخدمة بنجاح');

}

    public function update2(Request $request, $id)
    {
        $user = auth()->user();
    
        // جلب السجل الذي سيتم تحديثه
        $userServiceDetail = user_service_details::where('user_id', $user->id)->findOrFail($id);
    
        // تحديث البيانات
        $userServiceDetail->update([
            'service_id' => $request->service_id,
            'sub_service_id' => $request->sub_service_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    
        return redirect()->route('user_services')->with('success', 'تم تحديث الخدمة بنجاح');
    }
    

    public function delete($id)
    {
        $user = auth()->user();
        $userServiceDetail = user_service_details::where('user_id', $user->id)->findOrFail($id);
        $userServiceDetail->delete();
        return redirect()->route('user_services')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
