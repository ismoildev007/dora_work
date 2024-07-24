<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'client_id',
        'manager_id',
        'status',
    ];

    // Relationship with Client (inverse one-to-many)
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    // Relationship with Manager (inverse one-to-many)
    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    // Relationship with Activities (one-to-many)
    public function activities()
    {
        return $this->hasMany(Activity::class, 'project_id', 'id');
    }
    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }
}
