<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;

class Position extends Model
{
    protected $fillable = [
        'name',
    ];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
