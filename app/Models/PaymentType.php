<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
        'name',
        'unit_id',
        'amount',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
