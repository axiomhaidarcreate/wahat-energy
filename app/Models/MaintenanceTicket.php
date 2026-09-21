<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceTicket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ticket_number', 'customer_id', 'solar_system_id', 'subject', 'description', 'status', 'technician_id'
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
    public function technician() { return $this->belongsTo(User::class, 'technician_id'); }
    public function tasks() { return $this->hasMany(MaintenanceTask::class); }
}