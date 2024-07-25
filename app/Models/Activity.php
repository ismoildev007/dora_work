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
        'staff_id',
//        'client_id',
        'project_id',
    ];

    // Relationship with Staff (inverse one-to-many)
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    // Relationship with Client (inverse one-to-many)
//    public function client()
//    {
//        return $this->belongsTo(Client::class, 'client_id', 'id');
//    }

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
