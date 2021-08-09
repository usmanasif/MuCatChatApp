<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversations extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'conversation_salt'];
    use HasFactory;


}
