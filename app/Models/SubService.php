<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    
    

    public function userDetails()
    {
        return $this->hasMany(user_service_details::class, 'sub_service_id', 'id');
    }
}


