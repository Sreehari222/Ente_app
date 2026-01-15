<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInstallment extends Model
{
    use HasFactory;
protected $fillable = [
        'payment_id',
        'installment_number',
        'amount',
        'payment_mode',
        'transaction_id',
        'denominations',
        'paid_at',
        'due_date'
    ];

    protected $casts = [
        'denominations' => 'array'
    ];
}
