@extends('admin.home')

@section('content')
<div class="container bg-white" dir="rtl">
    <!-- زر فتح مودال الإضافة -->
    <button type="button" class="btn my-3 text-white" data-bs-toggle="modal" data-bs-target="#addUserModal" style="background-color: #d88d5b">
        إضافة مستخدم
    </button>

    @if(session('success'))
    <div class="alert text-black d-flex align-items-center" style="padding: 10px; border-radius: 5px; display: inline-flex;">
        <span>{{ session('success') }}</span>
        <i class="fas fa-check-circle" style="color: #28a745; margin-left: 10px; font-size: 20px; background-color: white; border-radius: 50%; padding: 2px;"></i>
    </div>
@endif

    <table class="table">
        <thead class="table">
            <tr>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>نوع المستخدم</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @switch($user->user_type)
                            @case('Admin') مدير @break
                            @case('Company') شركة @break
                            @case('Freelancer') مستقل @break
                            @case('Client') عميل @break
                            @default نوع غير معروف
                        @endswitch
                    </td>
                    <td>
                        <!-- زر تعديل لتفعيل الـ Modal -->
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}">
                            تعديل
                        </button>

                        <!-- نموذج حذف -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal لتعديل بيانات المستخدم -->
                <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header  text-white">
                                <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">تعديل بيانات المستخدم</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- نموذج التعديل داخل الـ Modal -->
                                <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">الاسم</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                       <input type="hidden" name="user_type" value="Freelancer">
                                       <input type="hidden" name="status" value="active">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">كلمة المرور</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="form-text text-muted">اترك هذا الحقل فارغًا إذا لم ترغب في تغيير كلمة المرور.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">الوصف</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"  value="{{ $user->description }}">{{ $user->description }}</textarea>
                                    <div class="mb-3">
                                        <label for="facebook_url" class="form-label">رابط فيسبوك</label>
                                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ $user->facebook_url }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="linkedin_url" class="form-label">رابط لينكد إن</label>
                                        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ $user->linkedin_url }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="instagram_url" class="form-label">رابط إنستغرام</label>
                                        <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="{{ $user->instagram_url }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="twitter_url" class="form-label">رابط تويتر</label>
                                        <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="{{ $user->twitter_url }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">الموقع</label>
                                        <input type="text" class="form-control" id="location" name="location" value="{{ $user->location }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">الصورة الشخصية</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-outline-white" style="background-color:#d88d5b">حفظ التعديلات</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-white" style="background-color:#d88d5b" data-bs-dismiss="modal">إغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal لإضافة مستخدم جديد -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="addUserModalLabel">إضافة مستخدم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ادخل الاسم" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="ادخل البريد الإلكتروني" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <input type="hidden" name="user_type" value="Freelancer">
                        <input type="hidden" name="status" value="active">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="ادخل كلمة المرور" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="ادخل رقم الهاتف">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="ادخل العنوان">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="description" name="description" placeholder="ادخل الوصف"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="facebook_url" class="form-label">رابط فيسبوك</label>
                        <input type="url" class="form-control" id="facebook_url" name="facebook_url" placeholder="ادخل رابط فيسبوك">
                    </div>
                    <div class="mb-3">
                        <label for="linkedin_url" class="form-label">رابط لينكد إن</label>
                        <input type="url" class="form-control" id="linkedin_url" name="linkedin_url"    placeholder="ادخل رابط لينكد أن">
                    </div>
                    <div class="mb-3">
                        <label for="instagram_url" class="form-label">رابط إنستغرام</label>
                        <input type="url" class="form-control" id="instagram_url" name="instagram_url"    placeholder="ادخل رابط أنستغرام">
                    </div>
                    <div class="mb-3">
                        <label for="twitter_url" class="form-label">رابط تويتر</label>
                        <input type="url" class="form-control" id="twitter_url" name="twitter_url"    placeholder="ادخل رابط تويتر">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">الموقع</label>
                        <input type="text" class="form-control" id="location" name="location"    placeholder="ادخل الموقع">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">الصورة الشخصية</label>
                        <input type="file" class="form-control" id="image" name="image"   placeholder="ادخل الصورة الشخصية">
                    </div>
                    <button type="submit" class="btn btn-outline-white" style="background-color:#d88d5b">إضافة</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-white" style="background-color:#d88d5b" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript للتعامل مع تحديث الحالة -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // عندما يتم النقر على حالة المستخدم، قم بتحديث الحالة عبر AJAX
        $('span[id^="status-"]').on('click', function() {
            var statusElement = $(this);
            var userId = statusElement.attr('id').split('-')[1];
            var currentStatus = statusElement.text().trim() === 'نشط' ? 'Active' : 'Inactive';
            var newStatus = currentStatus === 'Active' ? 'Inactive' : 'Active';
            
            $.ajax({
                url: '/users/' + userId + '/update-status',
                method: 'PATCH',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // تحديث العنصر بناءً على الحالة الجديدة
                    statusElement.text(newStatus === 'Active' ? 'نشط' : 'غير نشط');
                    statusElement.removeClass(currentStatus === 'Active' ? 'bg-success' : 'bg-danger');
                    statusElement.addClass(newStatus === 'Active' ? 'bg-success' : 'bg-danger');
                }
            });
        });
    });
</script>
@endsection
