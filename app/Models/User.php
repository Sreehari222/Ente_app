<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

   protected $fillable = [
    'name',
    'email',
    'password',
    'role',

    'phone_number',
    'address',

    'account_number',
    'ifsc_code',

    'area_operator_id',
    'deo_id',

    'profile_photo',
    'cover_photo',

    'email_verified_at',
    'last_login_at',
    'last_logout_at',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // =====================
    // ROLE RELATIONSHIPS
    // =====================

    public function deos()
    {
        return $this->hasMany(User::class, 'area_operator_id')
            ->where('role', 'deo');
    }

    public function areaOperator()
    {
        return $this->belongsTo(User::class, 'area_operator_id');
    }


    public function deo()
    {
        return $this->belongsTo(User::class, 'deo_id');
    }

    // =====================
    // MESSAGE RELATIONSHIP
    // =====================

    public function messages()
    {
        return $this->belongsToMany(Message::class)
            ->withPivot(['is_read', 'read_at'])
            ->withTimestamps();
    }


    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class);
    }

    public function lastLogin()
    {
        return $this->hasOne(UserActivityLog::class)
            ->where('action', 'login')
            ->latest();
    }

    public function lastLogout()
    {
        return $this->hasOne(UserActivityLog::class)
            ->where('action', 'logout')
            ->latest();
    }

    public function vendors()
    {
        return $this->hasMany(Vendor::class, 'created_by');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'user_id');
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function salesmen()
    {
        return $this->hasMany(User::class, 'deo_id');
    }





}
