<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Clinician extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'clinicians';


    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'is_online'
    ];


    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // get pending image assigned
    public function pendingImage()
    {
        return $this->hasOne(Image::class)->where('status', 'pending');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
