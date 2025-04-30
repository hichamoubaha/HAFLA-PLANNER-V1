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
        'profile_picture',
        'last_name',
        'address',
        'city',
        'zip_code'
    ];

    protected $hidden = ['password'];

    public const ROLE_USER = 'user';
    public const ROLE_PRESTATAIRE = 'prestataire';
    public const ROLE_ORGANISATEUR = 'organisateur';

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

    public function customizedInvitations()
    {
        return $this->hasMany(CustomizedInvitation::class);
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function isPrestataire()
    {
        return $this->role === self::ROLE_PRESTATAIRE;
    }

    public function isOrganisateur()
    {
        return $this->role === self::ROLE_ORGANISATEUR;
    }
}
