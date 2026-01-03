<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'mode', 'transaction_id', 'status','transaction_id'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
