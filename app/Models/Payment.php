<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'plan_id',
        'total_amount',
        'emi_duration',
        'emi_amount'
    ];

    public function installments()
    {
        return $this->hasMany(PaymentInstallment::class);
    }

    public function paidAmount()
    {
        return $this->installments()->sum('amount');
    }

    public function remainingAmount()
    {
        return $this->total_amount - $this->paidAmount();
    }

    public function vendor()
{
    return $this->belongsTo(Vendor::class);
}



}
