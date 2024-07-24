<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone_number',
        'address',
    ];

    // Relationship with Projects (one-to-many)
    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }

    // Relationship with Activities (one-to-many)
    public function activities()
    {
        return $this->hasMany(Activity::class, 'client_id', 'id');
    }
}
