@extends('freelancer.home')

@section('content')
<div class="bg-white border rounded p-3" dir="rtl">
    <!-- زر فتح مودال إضافة خدمة -->
    <div class="text-end mb-3">
        <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#addUserServiceModal" style="background-color: #d88d5b">
            إضافة خدمة
        </button>
    </div>

    @if(session('success'))
        <div class="alert text-black d-flex align-items-center" style="padding: 10px; border-radius: 5px; display: inline-flex;">
            <span>{{ session('success') }}</span>
            <i class="fas fa-check-circle" style="color: #28a745; margin-left: 10px; font-size: 20px; background-color: white; border-radius: 50%; padding: 2px;"></i>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>الخدمة</th>
                <th>الخدمة الفرعية</th>
                <th>السعر</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userServices as $userService)
                <tr>
                    <td>{{ $userService->service->name }}</td>
                    <td>{{ $userService->subService->name }}</td>
                    <td>{{ $userService->price }}</td>
                    <td>
                        <!-- زر تعديل لتفعيل الـ Modal -->
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editUserServiceModal-{{ $userService->id }}">
                            تعديل
                        </button>

                        <!-- نموذج حذف -->
                        <form action="{{ route('user_services.delete', $userService->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal لتعديل بيانات الخدمة -->
                <div class="modal fade" id="editUserServiceModal-{{ $userService->id }}" tabindex="-1" aria-labelledby="editUserServiceModalLabel-{{ $userService->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-white">
                                <h5 class="modal-title" id="editUserServiceModalLabel-{{ $userService->id }}">تعديل بيانات الخدمة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user_services.update2', $userService->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="service_id" class="form-label">اختر الخدمة</label>
                                        <select class="form-control" id="service_id" name="service_id" required>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ $service->id == $userService->service_id ? 'selected' : '' }}>
                                                    {{ $service->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sub_service_id" class="form-label">اختر الخدمة الفرعية</label>
                                        <select class="form-control" id="sub_service_id" name="sub_service_id" required>
                                            @foreach($subServices as $subService)
                                                <option value="{{ $subService->id }}" {{ $subService->id == $userService->sub_service_id ? 'selected' : '' }}>
                                                    {{ $subService->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <textarea class="form-control" id="description" name="description" placeholder="أدخل وصف الخدمة" rows="3" required>{{ $userService->description }}</textarea>
                                        <label for="description">الوصف</label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">السعر</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="price" name="price" value="{{ $userService->price }}" required>
                                            <span class="input-group-text">LYD</span>
                                        </div>
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
<div class="modal fade" id="addUserServiceModal" tabindex="-1" aria-labelledby="addUserServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="addUserServiceModalLabel">إضافة خدمة جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user_services.save') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="service_id" class="form-label">اختر الخدمة</label>
                        <select class="form-control" id="service_id" name="service_id" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_service_id" class="form-label">اختر الخدمة الفرعية</label>
                        <select class="form-control" id="sub_service_id" name="sub_service_id" required>
                            @foreach($subServices as $subService)
                                <option value="{{ $subService->id }}">{{ $subService->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" id="description" name="description" placeholder="أدخل وصف الخدمة" rows="3" required></textarea>
                        <label for="description">الوصف</label>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">السعر</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="price" name="price" placeholder="أدخل السعر" required>
                            <span class="input-group-text">LYD</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-white w-100" style="background-color:#d88d5b">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
