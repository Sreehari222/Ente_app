<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    protected $fillable = [
        'user_id',
        'requested_role',
        'document_path',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

