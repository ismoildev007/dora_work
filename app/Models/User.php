<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telegram',
        'phone_number',
        'address',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationship with Manager (one-to-one)
    public function manager()
    {
        return $this->hasOne(Manager::class, 'user_id', 'id');
    }

    // Relationship with Staff (one-to-one)
    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }

    // Relationship with Messages (one-to-many)
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }

    // Relationship with Participants (many-to-many)
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'participants', 'user_id', 'conversation_id')
            ->withTimestamps();
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'staff_id', 'id');
    }
}
