<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAccount extends Model
{
    protected $fillable = [
        'bank_name',
        'account_number',
        'account_name',
        'is_active',
    ];
}
