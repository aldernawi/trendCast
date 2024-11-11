@extends('company.home')

@section('content')
<div class=" bg-white" dir="rtl">
    <div class="justify-content-between mb-3">
        <h3 class="text-center">تقرير خدمات الشركة</h3>
        <button id="printButton" class="btn btn-outline-white text-white align-self-end" style="background-color: #d88d5b">طباعة</button>
    </div>

    <table class="table table-bordered" id="printTable">
        <thead class="table">
            <tr>
                <th>الخدمة</th>
                <th>عدد الحجوزات</th>
                <th>تقييم الخدمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->subService->name }}</td>
                    <td>{{ $service->booking->count() }}</td>
                    <td>{{ round($service->averageRating(), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript لطباعة الجدول -->
<script>
    document.getElementById('printButton').addEventListener('click', function () {
        var printContents = document.getElementById('printTable').outerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = '<div style="margin-top: 50px; font-size: 18px;">' + printContents + '</div>';

        window.print();

        document.body.innerHTML = originalContents;
    });
</script>
@endsection
