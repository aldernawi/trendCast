<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{



    protected $fillable = ['user_id', 'favoritable_id', 'favoritable_type'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function favoritable()
    {
        return $this->morphTo();
    }

    
}