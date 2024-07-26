<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'description',
        'activity_type',
        'activity_date',
        'user_id',
        'project_id',
    ];

    // Relationship with Staff (inverse one-to-many)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship with Project (inverse one-to-many)
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    // Relationship with ActivityImages (one-to-many)
    public function images()
    {
        return $this->hasMany(ActivityImage::class, 'activity_id', 'id');
    }
}
