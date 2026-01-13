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
        'area_operator_id',
        'deo_id',
        'email_verified_at',
        'profile_photo',
        'cover_photo',
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

    public function salesmen()
    {
        return $this->hasMany(User::class, 'deo_id')
            ->where('role', 'salesman');
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
}
