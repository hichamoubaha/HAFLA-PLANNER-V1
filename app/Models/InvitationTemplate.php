<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'thumbnail_path',
        'default_colors',
        'layout_config',
        'customizable_fields',
        'is_active'
    ];

    protected $casts = [
        'default_colors' => 'array',
        'layout_config' => 'array',
        'customizable_fields' => 'array',
        'is_active' => 'boolean'
    ];

    // Template types constants
    const TYPE_WEDDING = 'wedding';
    const TYPE_BIRTHDAY = 'birthday';
    const TYPE_CONFERENCE = 'conference';
    const TYPE_PARTY = 'party';
    const TYPE_BUSINESS = 'business';

    public static function getTemplateTypes()
    {
        return [
            self::TYPE_WEDDING,
            self::TYPE_BIRTHDAY,
            self::TYPE_CONFERENCE,
            self::TYPE_PARTY,
            self::TYPE_BUSINESS
        ];
    }

    public function getDefaultColorsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setDefaultColorsAttribute($value)
    {
        $this->attributes['default_colors'] = json_encode($value);
    }

    public function getLayoutConfigAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setLayoutConfigAttribute($value)
    {
        $this->attributes['layout_config'] = json_encode($value);
    }

    public function getCustomizableFieldsAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    public function setCustomizableFieldsAttribute($value)
    {
        $this->attributes['customizable_fields'] = json_encode($value);
    }
}
