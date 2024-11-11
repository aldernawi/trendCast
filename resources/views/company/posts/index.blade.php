@extends('company.home')

@section('content')
<div class="bg-white border rounded p-3" dir="rtl">
    <!-- زر فتح مودال إضافة منشور -->
    <div class="text-end mb-3">
        <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#addPostModal" style="background-color: #d88d5b">
            إضافة منشور
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
                <th>العنوان</th>
                <th>الوصف</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td class="max-td text-break" style="max-width: 200px;">
                        <div class="text-truncate" id="post-description-{{ $post->id }}">
                            {{ Str::limit($post->description, 100) }} <!-- عرض أول 100 حرف فقط -->
                        </div>
                    </td>
                                        <td>
                        <!-- زر تعديل لتفعيل الـ Modal -->
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPostModal-{{ $post->id }}">
                            تعديل
                        </button>

                        <!-- نموذج حذف -->
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal لتعديل بيانات المنشور -->
                <div class="modal fade" id="editPostModal-{{ $post->id }}" tabindex="-1" aria-labelledby="editPostModalLabel-{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-white">
                                <h5 class="modal-title" id="editPostModalLabel-{{ $post->id }}">تعديل المنشور</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="mb-3">
                                        <label for="title" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">الوصف</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $post->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="images" class="form-label">الصور</label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                                        @if($post->images)
                                            <div class="mt-2">
                                                @foreach($post->images as $image)
                                                    <img src="{{ asset('post-images/' . $image->path) }}" alt="image" class="img-thumbnail" style="width: 100px; height: auto;">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn w-100" style="background-color: #d88d5b; color: white;">تحديث</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal لإضافة منشور جديد -->
<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="addPostModalLabel">إضافة منشور جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">العنوان</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">الوصف</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">الصورة</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                    </div>
                    <button type="submit" class="btn w-100" style="background-color: #d88d5b; color: white;">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
