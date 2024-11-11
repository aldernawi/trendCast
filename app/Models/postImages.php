<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'path',
    ];


    public function post()
    {
        return $this->belongsTo(posts::class, 'post_id', 'id');
    }
}
