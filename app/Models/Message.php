<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'type', 'seen_at',
        'message_source', 'conversation_id', 'reply_to_id', 'user_id'
    ];

    public const TYPES = [
        'plain',
        'file',
        'emoji',
        'mixed'
    ];

    protected $casts = [
        'seen_at' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

}
