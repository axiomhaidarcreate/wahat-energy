<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarReading extends Model
{
    protected $fillable = [
        'solar_system_id', 'reading_time', 'energy_produced_kwh', 'current_power_w'
    ];

    protected $casts = [
        'reading_time' => 'datetime',
        'energy_produced_kwh' => 'decimal:2',
        'current_power_w' => 'decimal:2',
    ];

    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
}