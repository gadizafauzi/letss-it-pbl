<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsSetting extends Model
{
    protected $table = 'cms_settings';

    protected $fillable = [
        'key',
        'value',
        'type',
    ];
}
