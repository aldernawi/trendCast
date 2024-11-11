<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_service_details extends Model
{
    use HasFactory;

    protected $table = 'user_service_details';

    protected $fillable = [
        'user_id',
        'service_id',
        'sub_service_id',
        'description',
        'price',
    ];
        
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id', 'id');
        }
        
        public function service()
        {
            return $this->belongsTo(Service::class, 'service_id', 'id');
        }
        
        public function subService()
        {
            return $this->belongsTo(SubService::class, 'sub_service_id', 'id');
        }

        public function booking()
        {
            return $this->hasMany(bookings::class, 'service_id', 'id');
        }

        public function favorites()
        {
            return $this->morphMany(Favorite::class, 'favoritable');
        }
        public function ratings()
{
    return $this->hasMany(Rating::class, 'service_id');
}

public function averageRating()
{
    return $this->ratings()->avg('rating');
}

    }
    
