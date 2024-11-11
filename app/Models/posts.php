<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
            ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(postImages::class, 'post_id', 'id');
    }
    public function comments()
{
    return $this->hasMany(Comment::class, 'post_id', 'id');
}

public function reports()
{
    return $this->hasMany(Report::class, 'post_id', 'id');


}


}