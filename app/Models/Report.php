<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'profit',
        'outlay',
        'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
