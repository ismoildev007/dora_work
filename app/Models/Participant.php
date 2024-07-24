<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'user_id',
    ];

    // Relationship with Conversation (inverse one-to-many)
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }

    // Relationship with User (inverse one-to-many)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
