<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract',
        'price',
        'service_name',
        'service_type'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
