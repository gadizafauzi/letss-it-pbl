<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsHeroSection extends Model
{
    protected $table = 'cms_hero_sections';

    protected $fillable = [
        'page',
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'button_secondary_text',
        'button_secondary_link',
        'badge_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
