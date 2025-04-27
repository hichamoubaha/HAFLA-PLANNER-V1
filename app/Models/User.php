<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_picture'
    ];


    protected $hidden = ['password'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function serviceProvider()
    {
        return $this->hasOne(ServiceProvider::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
