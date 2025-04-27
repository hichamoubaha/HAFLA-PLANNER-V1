<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'business_name',
        'description',
        'service_type',
        'location',
        'min_budget',
        'max_budget',
        'availability',
        'rating',
        'total_reviews',
        'profile_picture'
    ];

    protected $casts = [
        'availability' => 'array',
        'min_budget' => 'decimal:2',
        'max_budget' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
} 