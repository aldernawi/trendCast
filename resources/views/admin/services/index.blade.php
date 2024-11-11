@extends('admin.home')

@section('content')
<div class="container bg-white border rounded" dir="rtl">

    <!-- زر فتح مودال إضافة خدمة -->
    <button type="button" class="btn my-3 text-white" data-bs-toggle="modal" data-bs-target="#addServiceModal" style="background-color: #d88d5b">
        إضافة خدمة
    </button>

    @if(session('success'))
    <div class="alert text-black d-flex align-items-center" style="padding: 10px; border-radius: 5px; display: inline-flex;">
        <span>{{ session('success') }}</span>
        <i class="fas fa-check-circle" style="color: #28a745; margin-left: 10px; font-size: 20px; background-color: white; border-radius: 50%; padding: 2px;"></i>
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>اسم الخدمة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>
                        <!-- زر فتح مودال التعديل -->
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal-{{ $service->id }}">
                            تعديل
                        </button>

                        <!-- نموذج حذف -->
                        <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>

                        <!-- زر عرض الخدمات الفرعية -->
                        <a href="{{ route('subServices.index', $service->id) }}" class="btn btn-sm btn-outline-primary">
                            عرض الخدمات الفرعية
                        </a>
                    </td>
                </tr>

                <!-- Modal لتعديل بيانات الخدمة -->
                <div class="modal fade" id="editServiceModal-{{ $service->id }}" tabindex="-1" aria-labelledby="editServiceModalLabel-{{ $service->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-white">
                                <h5 class="modal-title" id="editServiceModalLabel-{{ $service->id }}">تعديل بيانات الخدمة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('services.update', $service) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">اسم الخدمة</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                                    </div>

                                    <button type="submit" class="btn btn-outline-white w-100" style="background-color:#d88d5b">تحديث</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal لإضافة خدمة -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="addServiceModalLabel">إضافة خدمة جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الخدمة</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ادخل اسم الخدمة" required>
                    </div>

                    <button type="submit" class="btn btn-outline-white w-100" style="background-color:#d88d5b">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
