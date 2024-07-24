<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'content',
    ];

    // Relationship with Conversation (inverse one-to-many)
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    // Relationship with User (inverse one-to-many)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
