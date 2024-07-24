<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'manager_id',
        'position',
        'phone_number',
    ];

    public $timestamps = false;

    // Relationship with User (inverse one-to-one)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship with Manager (inverse one-to-many)
    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    // Relationship with Activities (one-to-many)
    public function activities()
    {
        return $this->hasMany(Activity::class, 'staff_id', 'id');
    }
}
