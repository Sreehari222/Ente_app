<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'provider_id',
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
        'payment_mode',
        'transaction_id',
        'reference_number',
        'photo',
        'gallery',
        'social_links',
        'special_recommendation',
        'internal_comments',
        'verification_status',
    ];

    protected $casts = [
        'gallery' => 'array',
        'social_links' => 'array',
    ];

    /* RELATIONS */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(Category::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
