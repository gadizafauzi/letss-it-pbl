<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsWelcomeMessage extends Model
{
    protected $table = 'cms_welcome_messages';

    protected $fillable = [
        'title',
        'greeting',
        'paragraphs',
        'kepsek_name',
        'kepsek_title',
        'kepsek_photo',
        'is_active',
    ];

    protected $casts = [
        'paragraphs' => 'array',
        'is_active' => 'boolean',
    ];
}
