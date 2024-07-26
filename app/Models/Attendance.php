<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'date',
        'status',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relationship with Staff (inverse one-to-one)
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
