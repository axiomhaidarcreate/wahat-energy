<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicianAssignment extends Model
{
    protected $fillable = [
        'installation_id', 'technician_id'
    ];

    public function installation() { return $this->belongsTo(Installation::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
}