<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('subServices')->get();
        return view('admin.services.index', compact('services'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            
        ]);

        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'تمت إضافة الخدمة بنجاح');
    }


    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
