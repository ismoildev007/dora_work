<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
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
        return $this->belongsTo(Project::class);
    }

    // Event listener for creating a transaction when an agreement is created
    protected static function booted()
    {
        static::created(function ($agreement) {
            Transaction::create([
                'agreement_id' => $agreement->id,
                'residual' => $agreement->price,
                'profit' => 0
            ]);
        });
    }
}