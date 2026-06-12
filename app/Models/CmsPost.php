<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPost extends Model
{
    protected $table = 'cms_posts';

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'status',
        'views_count',
        'publish_date',
        'meta_title',
        'meta_description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'views_count' => 'integer',
        'publish_date' => 'datetime',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(CmsPostCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
