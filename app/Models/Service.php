<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function subServices()
    {
        return $this->hasMany(SubService::class, 'service_id', 'id');
    }


        public function userDetails()
        {
            return $this->hasMany(user_service_details::class, 'service_id', 'id');
        }
    }
    


