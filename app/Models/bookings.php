<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'company_id',
        'service_id',
        'status',
        'booking_date',
        'payment_status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function service()
    {
        return $this->belongsTo(user_service_details::class, 'service_id');
    }
}
