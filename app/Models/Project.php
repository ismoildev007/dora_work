<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_inn',
        'company_name',
        'company_person',
        'start_date',
        'end_date',
        'project_status',
        'payment_status', // 'paid', 'partially_paid', 'unpaid'
        'agreement_id',
        'client_id',
        'manager_id',
    ];

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'project_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id', 'id');
    }
}
