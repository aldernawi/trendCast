<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SubService;
use Illuminate\Http\Request;

class SubServiceController extends Controller
{public function index($serviceId)
    {
        $subServices = SubService::with('service')->where('service_id', $serviceId)->get();
        return view('admin.sub_services.index', compact('subServices', 'serviceId'));
    }
    
    public function create(Service $service)
    {
        return view('sub_services.create', compact('service'));
    }
    
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id', // التحقق من أن الخدمة موجودة
        ]);
    
        // إنشاء الخدمة الفرعية
        SubService::create([
            'service_id' => $request->service_id,
            'name' => $request->name,
        ]);
    
        return redirect()->back()->with('success', 'تمت إضافة الخدمة الفرعية بنجاح');
    }
    
    

    public function edit(Service $service, SubService $subService)
    {
        return view('sub_services.edit', compact('service', 'subService'));
    }

    public function update(Request $request, Service $service, SubService $subService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subService->update($request->all());

        return redirect()->back()->with('success', 'تم تحديث الخدمة الفرعية بنجاح');
    }

    public function destroy(Service $service, SubService $subService)
    {
        $subService->delete();
        return redirect()->back()->with('success', 'تم حذف الخدمة الفرعية بنجاح');
    }
}
