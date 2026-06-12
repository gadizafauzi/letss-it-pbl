<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsTestimonial extends Model
{
    protected $table = 'cms_testimonials';

    protected $fillable = [
        'quote',
        'name',
        'role',
        'avatar',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
