<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Message extends Model
{

    protected $fillable = [
        'sender_id',
        'title',
        'message',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Users in this chat
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['is_read', 'read_at'])
            ->withTimestamps();
    }


    /**
     * Replies inside chat
     */
    public function replies()
    {
        return $this->hasMany(MessageReply::class);
    }
}
