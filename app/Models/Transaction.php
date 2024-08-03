<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;


    protected $fillable = [
        'agreement_id',
        'residual',
        'profit'
    ];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }
}
