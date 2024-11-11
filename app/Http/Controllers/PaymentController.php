<?php
namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Plutu\Services\PlutuLocalBankCards;

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use Plutu\Services\PlutuLocalBankCards;

class PaymentController extends Controller
{
    public function handleCallback(Request $request, PlutuLocalBankCards $api)
    {
        // إعداد بيانات الاعتماد للـ API
        $api->setCredentials(
            '984adf4c-44e1-418f-829b', 
            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDI3N2M4YjQ3YTY5NjBkOTY4NzA1NGI3YjZkNjRmNDM3MjI3Yzk5MjgyMzNmNWNjMjFhZTQyMDVkOWE2MzNmMTVkNTAwZDJiYWNjOGM3ODEiLCJpYXQiOjE3MjQ0MjYyNzguOTcwMjI2LCJuYmYiOjE3MjQ0MjYyNzguOTcwMjI3LCJleHAiOjIwMzk5NTkwNzguOTYzMzkzLCJzdWIiOiI5NjciLCJzY29wZXMiOlsic2FuZGJveCJdfQ.rCLWfSeMlb8Fd5RbjQPoeWhtsp9RLvmOes3Bf-UZDUjTmE8SvxTYxhba73XqR1TwORqVE1ezd1rkDE4n83pqsLHST7JWuxfRY_XR0N4P_4B3-pSzq6b7X7-t4bkhRmVEFfrAnIdaWOJbc0mqmRgJnKU97CGKLftMS_YyDtVs9bXKkZinNUElGg-PEOWjlF___yUMBr3V1Uf5HsNrtZpA6ZKC_NnIc4Oa3zmy3TQTmOScD2cn2Iv1HSIMi9OglaEQMjWlmKYop9fyS3AMzhWbKp1dCNiZL9MZx5KDz2i-Jx_-bMwUB7r53V-lY1d76Y7YTI6JVXOt0VQsU7AwtOErrF1cqVwehFrdkI1NKYyD1OZNeBqIfqPM7Uabu4wWbsF-Gb4hiv1aESljdfW1sEcqr4q6uUzrZvnB9iyaY9wGRrDVVu5YjsaS5usSGixLPpaF7br33G2pYfemC6bi5bHgbLROXqbZQttvD2c-Pewdc5HAsqvlIDCqf7O9B4cJN_lX84p7K9lnVt3t19h-FdLdIsuy9PFSXTMB3ydMW5lvuWY8DRcs3Qb9qYKJs0tZ8k9537MUkRiegIUM-_c69OU9twypMDDQ81u6Vy9LW2YRdPkId0cjyYni8p6e86WtZpoyJxWF2xjm4SqHKFav63Xfo7w-M5zToFUkEgZi5HILDE8'
        );
        $parameters = $request->all();

        try {
            $callback = $api->callbackHandler($parameters);
            $transactionId = $callback->getParameter('invoice_no');
            $booking = Bookings::findOrFail($transactionId);

            if ($callback->isApprovedTransaction()) {
                $booking->payment_status = 'Paid';
                $booking->save();
                return redirect()->route('home'); 
            }
            if ($callback->isCanceledTransaction()) {
                $booking->payment_status = 'Failed';
                $booking->save();
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            return redirect()->route('home');   
        }
    }
}


