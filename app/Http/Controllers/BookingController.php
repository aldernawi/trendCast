<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\notice;
use Illuminate\Support\Facades\Log;
use App\Notifications\BookingStatusNotification;
use Plutu\Services\PlutuSadad;
class BookingController extends Controller
{
    // قبول الحجز
  
    public function createBooking(Request $request)
{
    try {
        $booking = new Bookings();
        $booking->client_id = $request->client_id;
        $booking->company_id = $request->company_id;
        $booking->service_id = $request->service_id;
        $booking->booking_date = now();
        $booking->save();
    
        return response()->json(['success' => true, 'message' => 'تم إنشاء الحجز بنجاح']);
    } catch (\Exception $e) {
        // تسجيل الخطأ في الـlog
        Log::error('Error creating booking: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء إنشاء الحجز.']);
    }
}

public function acceptBooking($bookingId)
{
    $booking = Bookings::find($bookingId);
    if ($booking) {
        $booking->status = 'Accepted';
        $booking->save();

        notice::create([
            'user_id' => $booking->client->id,
            'message' => 'تم قبول حجزك، يرجى الدفع.',
        ]);

        return redirect()->back()->with('success', 'تم قبول الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}

public function rejectBooking($bookingId)
{
    $booking = Bookings::find($bookingId);
    if ($booking) {
        $booking->status = 'Rejected';
        $booking->save();
        
        notice::create([
            'user_id' => $booking->client->id,
            'message' => 'تم رفض حجزك.',
        ]);
        return redirect()->back()->with('success', 'تم رفض الحجز بنجاح');
    } else {
        return redirect()->back()->with('error', 'الحجز غير موجود');
    }
}
// إلغاء الحجز من قبل العميل إذا كانت الحالة معلقة
public function cancelBooking($bookingId)
{
    $booking = Bookings::find($bookingId);

    if ($booking && $booking->status === 'Pending') {
        $booking->status = 'Canceled';
        $booking->save();

        return response()->json(['message' => 'تم الغاء الحجز بنجاح'], 200);
    }

    return response()->json(['message' => 'لا يمكنك الغاء هذا الحجز'], 400);
}


// عرض الحجوزات
public function getBookings()
{
    $bookings = Bookings::where('company_id', auth()->id())->get();
    return view('company.bookings.index', compact('bookings'));
}

public function index() {
$booking=Bookings::where('client_id',auth()->id())->get();
return view('client.bookings.index',compact('booking'));
}
public function payment(Bookings $booking)
{
   
    $mobileNumber = '0913632323'; 
    $birthYear = '1991'; 
    $amount = $booking->service->price * 0.5;
  
    $api = new PlutuSadad;

    $api->setCredentials(
        '984adf4c-44e1-418f-829b',
      'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTk2MmVhNjEwYzIyZWViNmQwOTEzMTNhYjc2NjU2MTA4MzNlYjg4MjcxODc0MDNlNDJhYjE0ZjMyZjMxMTY3YjM2MDg4MTYwNmUwYjQzN2EiLCJpYXQiOjE3MjU1NzYxMTEuNDYyNjE2LCJuYmYiOjE3MjU1NzYxMTEuNDYyNjE4LCJleHAiOjIwNDExMDg5MTEuNDU2MzM1LCJzdWIiOiI5NzYiLCJzY29wZXMiOlsic2FuZGJveCJdfQ.jjiGk5QGcY77G-AZhpUIqGNtVl2rKAgicKNLhwRW3uQ043C7grjN3myvLzWHvuCX-worJFMIKb5knCcLUAA9b-I5Gf0rnDsdtiYAlWKwnTZQ1aIeozG-oftWTmYXyKGMUKt5uZz18ihhxVUHuUepgKLUw11c9KX_Lsl4vD1jNr-1Z2EuT_1j4XXmCiBPI0wlDoNzXy59MoaKOMHahHaBacMkefGckyQYNk1jcJpT_1vtOveF9vQGsLysYh4ra7TFw0RzM4vH1oBM6Jz4HZG8ScNXYRYGRiZK1107gdZZtgGDD1pskdN3F_HLVGacNtw4nf67YO6qGguGMPF9AxK3llyFfz0CQ_a3enr-ZL9jom7_wLxZYLZtQy-xVyxmu_Ztrw7Ly85Pm8VEKKjU2YRKk1xEvqm0fnH_nvjbCrZi8pBgzBPoGyKnS0Y24B-FlYXJtLFIAJk-YmG_mxV_T5m4aeijTlFjVFYcpzI0CZakgIYpRHmeOcotedMjK3g8tSXFEBoz8CFWvPBk8m59b0VzVm7ZPnOMmwdtQj9Dl6gRkjr5uaLI3pl5wWFAzmjB-lVnEwSBLZMaX6ZuLXJCMQWoDt00xBZl0JvU2pm58lCeg6n1PLMO9Gt3IxpLfWz6ck-d_IgDP8vjRJCvwcnsQeociMJuQQZLqvhVHTt2NFNhGKQ',
       'sk_62785c83a5298fd7464446ee869e50c921e65ef3'
    );

    try {
        $apiResponse = $api->verify($mobileNumber, $birthYear, $amount);

        if ($apiResponse->getOriginalResponse()->isSuccessful()) {
       
            return $this->confirm($apiResponse->getProcessId(), $booking);
        } elseif ($apiResponse->getOriginalResponse()->hasError()) {
            $errorCode = $apiResponse->getOriginalResponse()->getErrorCode();
            $errorMessage = $apiResponse->getOriginalResponse()->getErrorMessage();
            $statusCode = $apiResponse->getOriginalResponse()->getStatusCode();
            $responseData = $apiResponse->getOriginalResponse()->getBody();
          return $responseData;
        }
    } catch (\Exception $e) {
        
        return $e->getMessage();
    }
}

public function confirm($id, Bookings $booking)
{
    $processId = $id;
    $code = '111111'; 
    $amount = $booking->service->price * 0.5;
    $invoiceNo = 'inv-12345'; 

    try {
        $api = new PlutuSadad;
        $api->setCredentials(
            '984adf4c-44e1-418f-829b',
            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTk2MmVhNjEwYzIyZWViNmQwOTEzMTNhYjc2NjU2MTA4MzNlYjg4MjcxODc0MDNlNDJhYjE0ZjMyZjMxMTY3YjM2MDg4MTYwNmUwYjQzN2EiLCJpYXQiOjE3MjU1NzYxMTEuNDYyNjE2LCJuYmYiOjE3MjU1NzYxMTEuNDYyNjE4LCJleHAiOjIwNDExMDg5MTEuNDU2MzM1LCJzdWIiOiI5NzYiLCJzY29wZXMiOlsic2FuZGJveCJdfQ.jjiGk5QGcY77G-AZhpUIqGNtVl2rKAgicKNLhwRW3uQ043C7grjN3myvLzWHvuCX-worJFMIKb5knCcLUAA9b-I5Gf0rnDsdtiYAlWKwnTZQ1aIeozG-oftWTmYXyKGMUKt5uZz18ihhxVUHuUepgKLUw11c9KX_Lsl4vD1jNr-1Z2EuT_1j4XXmCiBPI0wlDoNzXy59MoaKOMHahHaBacMkefGckyQYNk1jcJpT_1vtOveF9vQGsLysYh4ra7TFw0RzM4vH1oBM6Jz4HZG8ScNXYRYGRiZK1107gdZZtgGDD1pskdN3F_HLVGacNtw4nf67YO6qGguGMPF9AxK3llyFfz0CQ_a3enr-ZL9jom7_wLxZYLZtQy-xVyxmu_Ztrw7Ly85Pm8VEKKjU2YRKk1xEvqm0fnH_nvjbCrZi8pBgzBPoGyKnS0Y24B-FlYXJtLFIAJk-YmG_mxV_T5m4aeijTlFjVFYcpzI0CZakgIYpRHmeOcotedMjK3g8tSXFEBoz8CFWvPBk8m59b0VzVm7ZPnOMmwdtQj9Dl6gRkjr5uaLI3pl5wWFAzmjB-lVnEwSBLZMaX6ZuLXJCMQWoDt00xBZl0JvU2pm58lCeg6n1PLMO9Gt3IxpLfWz6ck-d_IgDP8vjRJCvwcnsQeociMJuQQZLqvhVHTt2NFNhGKQ',
             'sk_62785c83a5298fd7464446ee869e50c921e65ef3'
        );
        $apiResponse = $api->confirm($processId, $code, $amount, $invoiceNo);

        if ($apiResponse->getOriginalResponse()->isSuccessful()) {
         
            $booking->payment_status = 1;
            $booking->save();
            return 'تمت عملية الدفع بنجاح'; 
        } elseif ($apiResponse->getOriginalResponse()->hasError()) {
            
            $booking->payment_status = 0;
            $booking->save();
            return 'حدث خطأ اثناء عملية الدفع يرجى المحاولة لاحقا '; 
        }
    } catch (\Exception $e) {
       return $e->getMessage();
    }
}
public function showClientBookings()
{
    $client = auth()->user();

    $bookings = Bookings::where('client_id', $client->id)->get();



    return view('website.bookingClaint', compact('bookings'));
}

public function pay($id)
{
   
    $booking = Bookings::findOrFail($id);
    if ($booking) {
       
        // رابط الدفع
        $message = $this->payment($booking);

        $price = $booking->service->price;
        return response()->json([
            'message' => $message,
            'price' => $price,
            'status' => 200
        ]);
    } else {
        return response()->json([
            'message' => 'الحجز غير موجود'
        ], 404);
    }
}

}







