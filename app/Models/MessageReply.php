<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MessageReply extends Model
{
    protected $fillable = [
        'message_id',
        'sender_id',
        'message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
