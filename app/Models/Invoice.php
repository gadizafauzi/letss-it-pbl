<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id','payment_type','period',
        'amount','due_date','status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
