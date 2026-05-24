<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Unit;

class Subject extends Model
{
    protected $fillable = [

        'unit_id',

        'subject_code',
        'subject_name',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}