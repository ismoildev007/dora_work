<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';

    protected $fillable = [
        'user_id',
        'department_id',
        'position',
    ];

    public $timestamps = false;

    // Relationship with User (inverse one-to-one)

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship with Staff (one-to-many)
    public function staff()
    {
        return $this->hasMany(Staff::class, 'manager_id', 'id');
    }

    // Relationship with Projects (one-to-many)
    public function projects()
    {
        return $this->hasMany(Project::class, 'manager_id', 'id');
    }
}
