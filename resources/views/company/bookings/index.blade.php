@extends('company.home')

@section('content')

    <div class="card">
        <div class="card-body">
            <h1 class="mb-4 text-lg">قائمة الحجوزات</h1>

            <div class="table-responsive">
                <table id="bookingsTable" class="table">
                    <thead>
                        <tr>
                            <th>اسم العميل</th>
                            <th>اسم الشركة</th>
                            <th>الخدمة</th>
                            <th>تاريخ الحجز</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr id="booking-{{ $booking->id }}">
                                <td>{{ $booking->client->name }}</td>
                                <td>{{ $booking->company->name }}</td>
                                <td>{{ $booking->service->subService->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td class="status">
                                    @php
                                        $statusLabel = '';
                                        $statusClass = '';
                                        switch ($booking->status) {
                                            case 'Accepted':
                                                $statusLabel = 'مقبول';
                                                $statusClass = 'bg-success';
                                                break;
                                            case 'Rejected':
                                                $statusLabel = 'مرفوض';
                                                $statusClass = 'bg-danger';
                                                break;
                                            default:
                                                $statusLabel = 'معلق';
                                                $statusClass = 'bg-warning';
                                                break;
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td>
                                    @if($booking->status == 'Pending')
                                        <form action="{{ route('booking.accept', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">قبول</button>
                                        </form>
                                        <form action="{{ route('booking.reject', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">رفض</button>
                                        </form>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    

    <!-- إضافة مكتبة jQuery و Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    
@endsection
