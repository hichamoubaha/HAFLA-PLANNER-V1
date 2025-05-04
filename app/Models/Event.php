<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'user_id',
        'event_type',
        'category',
        'theme_colors',
        'logo_path',
        'custom_message',
        'media_gallery',
        'budget',
        'budget_breakdown',
        'max_participants',
        'amenities',
        'special_requirements',
        'contact_email',
        'contact_phone',
        'status',
        'price'
    ];

    protected $casts = [
        'date' => 'datetime',
        'theme_colors' => 'array',
        'media_gallery' => 'array',
        'budget_breakdown' => 'array',
        'amenities' => 'array',
        'budget' => 'decimal:2',
        'price' => 'decimal:2'
    ];

    /**
     * Get the media gallery attribute.
     *
     * @param  string  $value
     * @return array
     */
    public function getMediaGalleryAttribute($value)
    {
        if (empty($value)) {
            return [];
        }
        
        if (is_array($value)) {
            return $value;
        }
        
        return json_decode($value, true) ?: [];
    }

    /**
     * Set the media gallery attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setMediaGalleryAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['media_gallery'] = json_encode($value);
        } else {
            $this->attributes['media_gallery'] = $value;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
