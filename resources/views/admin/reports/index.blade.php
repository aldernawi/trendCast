@extends('admin.home')

@section('content')
<div class="container bg-white" dir="rtl">
    <h1 class="text-center mb-3">البلاغات</h1>

    @if(session('success'))
    <div class="alert text-black d-flex align-items-center" style="padding: 10px; border-radius: 5px; display: inline-flex;">
        <span>{{ session('success') }}</span>
        <i class="fas fa-check-circle" style="color: #28a745; margin-left: 10px; font-size: 20px; background-color: white; border-radius: 50%; padding: 2px;"></i>
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>سبب الإبلاغ</th>
                <th>الشخص المبلغ</th>
                <th>البوست</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->reason }}</td>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->post->title }}</td>
                    <td> 
                        <button class="btn btn-sm text-white" style="background-color: #d88d5b" 
                                data-toggle="modal" data-target="#postModal{{ $report->post->id }}">
                            عرض
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @foreach($reports as $report)
    <div class="modal fade" id="postModal{{ $report->post->id }}" tabindex="-1" role="dialog" aria-labelledby="postModalLabel{{ $report->post->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel{{ $report->post->id }}">{{ $report->post->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- عرض الصور -->
                    @if($report->post->images)
                        <div class="mt-2">
                            @foreach($report->post->images as $image)
                                <img src="{{ asset('post-images/' . $image->path) }}" alt="image" class="img-thumbnail" style="width: 100px; height: auto;">
                            @endforeach
                        </div>
                    @endif

                    <!-- عرض الوصف -->
                    <p class="mt-3">{{ $report->post->description }}</p>
                </div>
                <div class="modal-footer">
                    <!-- زر حذف المنشور -->
                    <form action="{{ route('admin.posts.destroy', $report->post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endsection
