<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_group',
    ];

    // Relationship with Messages (one-to-many)
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    // Relationship with Users (many-to-many)
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants', 'conversation_id', 'user_id')
            ->withTimestamps();
    }
}
