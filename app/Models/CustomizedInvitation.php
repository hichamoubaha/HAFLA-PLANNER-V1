<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'title',
        'date',
        'location',
        'description',
        'primary_color',
        'secondary_color',
        'cover_image_path',
        'custom_data'
    ];

    protected $casts = [
        'custom_data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(InvitationTemplate::class, 'template_id');
    }
}
