<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'shop_name',
        'owner_name',
        'mobile',
        'whatsapp',
        'email',
        'digipin',
        'address',
        'google_map',
        'service_area',
        'main_category_id',
        'category_id',
        'plan_id',
        'opening_time',
        'closing_time',
        'social_links',
        'photo',
        'gallery',
        'payment_mode',
        'transaction_id',
        'reference_number',
        'special_recommendation',
        'internal_comments',
        'status',
        'approved_at',
        'created_by'
    ];


    protected $casts = [
        'social_links' => 'array',
        'gallery' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
     // Main Category relationship
    public function mainCategory()
    {
        return $this->belongsTo(Category::class, 'main_category_id');
    }

    // Sub Category relationship
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Plan relationship
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}
