<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'status',
        'image',
        'target_url'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}