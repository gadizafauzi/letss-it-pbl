<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id','verified_by',
        'payment_method','school_account_id',
        'payment_date','payment_proof',
        'verification_status'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function schoolAccount()
    {
        return $this->belongsTo(SchoolAccount::class);
    }
}
