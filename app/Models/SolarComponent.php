<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarComponent extends Model
{
    protected $fillable = [
        'solar_system_id', 'product_id', 'serial_number'
    ];

    public function solarSystem() { return $this->belongsTo(SolarSystem::class); }
    public function product() { return $this->belongsTo(Product::class); }
}