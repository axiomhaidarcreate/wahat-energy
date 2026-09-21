<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolarSystem extends Model
{
    protected $fillable = [
        'customer_id', 'project_id', 'name', 'capacity_kw', 'installation_date'
    ];

    protected $casts = [
        'capacity_kw' => 'decimal:2',
        'installation_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function components() { return $this->hasMany(SolarComponent::class); }
    public function readings() { return $this->hasMany(SolarReading::class); }
}