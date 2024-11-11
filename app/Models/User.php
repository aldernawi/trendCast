<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
        'address',
        'description',
        'status',
        'image',
        'cover_image',
        'company_url',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'twitter_url',
        'location',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function posts()
    {
        return $this->hasMany(posts::class, 'user_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(user_service_details::class, 'user_id', 'id');
    }
    

    public function bookings()
    {
        return $this->hasMany(bookings::class, 'user_id', 'id');
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function addFavorite($favoritable)
    {
        $this->favorites()->updateOrCreate([
            'favoritable_id' => $favoritable->id,
            'favoritable_type' => get_class($favoritable),
        ]);
    }

    public function removeFavorite($favoritable)
    {
        $this->favorites()->where([
            'favoritable_id' => $favoritable->id,
            'favoritable_type' => get_class($favoritable),
        ])->delete();
    }
    public function ratings()
{
    return $this->hasMany(Rating::class);
}
public function comments()
{
    return $this->hasMany(Comment::class, 'user_id', 'id');
}

public function notifications()
{
    return $this->hasMany(Notice::class, 'user_id');
}



}