<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'image',
    ];

    // Relationship with ActivityNotification (inverse one-to-many)
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
