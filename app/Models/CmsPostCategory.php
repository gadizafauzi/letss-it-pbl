<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPostCategory extends Model
{
    protected $table = 'cms_post_categories';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
    ];

    public function posts()
    {
        return $this->hasMany(CmsPost::class, 'category_id');
    }
}
