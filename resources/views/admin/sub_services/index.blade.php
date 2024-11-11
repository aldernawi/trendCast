@extends('admin.home')

@section('content')
<div class="container bg-white" dir="rtl">
    <!-- زر فتح مودال إضافة خدمة فرعية -->
    <button type="button" class="btn  my-3 text-white" data-bs-toggle="modal" data-bs-target="#addSubServiceModal" style="background-color: #d88d5b">
        إضافة خدمة فرعية
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
                <th>اسم الخدمة الفرعية</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subServices as $subService)
                <tr>
                    <td>{{ $subService->name }}</td>
                    <td>
                        <!-- زر تعديل لتفعيل الـ Modal -->
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSubServiceModal-{{ $subService->id }}">
                            تعديل
                        </button>

                        <!-- نموذج حذف -->
                        <form action="{{ route('subServices.destroy', $subService) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal لتعديل بيانات الخدمة الفرعية -->
                <div class="modal fade" id="editSubServiceModal-{{ $subService->id }}" tabindex="-1" aria-labelledby="editSubServiceModalLabel-{{ $subService->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header  text-white">
                                <h5 class="modal-title" id="editSubServiceModalLabel-{{ $subService->id }}">تعديل بيانات الخدمة الفرعية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('subServices.update', $subService) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name-{{ $subService->id }}" class="form-label">اسم الخدمة الفرعية</label>
                                        <input type="text" class="form-control" id="name-{{ $subService->id }}" name="name" value="{{ $subService->name }}" required>
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

<!-- Modal لإضافة خدمة فرعية -->
<div class="modal fade" id="addSubServiceModal" tabindex="-1" aria-labelledby="addSubServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="addSubServiceModalLabel">إضافة خدمة فرعية جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('subServices.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم الخدمة الفرعية</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <input type="hidden" name="service_id" value="{{ $serviceId }}"> <!-- تأكد من تعيين القيمة الصحيحة -->
                    <button type="submit" class="btn btn-outline-white w-100" style="background-color:#d88d5b">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
