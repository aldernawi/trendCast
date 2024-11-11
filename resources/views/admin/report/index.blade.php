@extends('admin.home')

@section('content')
<div class="container bg-white" dir="rtl">
    <div class="d-flex justify-content-between mb-3">
        <h3>تقرير عام</h3>
        <button onclick="printTable()" class="btn btn-outline-white text-white" style="background-color:#d88d5b">طباعة التقرير</button>
    </div>

    <table class="table table-bordered" id="reportTable">
        <thead class="table">
            <tr>
                <th>شركائنا</th>
                <th>اجمالي الخدمات المُقدمة</th>
                <th>اجمالي المنشورات</th>
                <th>اجمالي الحجوزات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $services[$user->id] }}</td>
                    <td>{{ $posts[$user->id] }}</td>
                    <td>{{ $bookings[$user->id] }}</td>
                </tr>             
            @endforeach
        </tbody>
    </table>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #reportTable, #reportTable * {
            visibility: visible;
        }

        #reportTable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1em;
        }

        #reportTable th, #reportTable td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        #reportTable th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        #reportTable td {
            background-color: #ffffff;
        }

        /* التأكد من أن الجدول يظهر بحجم مناسب على ورقة A4 */
        @page {
            size: A4 portrait;
            margin: 20mm;
        }

        /* التأكد من أن الجدول يظهر كاملاً ضمن صفحة واحدة */
        table {
            page-break-inside: avoid;
        }

        /* إخفاء الزر عند الطباعة */
        .btn {
            display: none;
        }
    }
</style>

<script>
    function printTable() {
        window.print();
    }
</script>
@endsection
