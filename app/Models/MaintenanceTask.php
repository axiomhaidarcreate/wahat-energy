<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'maintenance_ticket_id', 'description', 'is_completed'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function maintenanceTicket() { return $this->belongsTo(MaintenanceTicket::class); }
}