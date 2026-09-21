<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'company_name', 'tax_number', 'type'
    ];

    public function addresses() { return $this->hasMany(CustomerAddress::class); }
    public function leads() { return $this->hasMany(Lead::class); }
    public function quotations() { return $this->hasMany(Quotation::class); }
    public function orders() { return $this->hasMany(Order::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function projects() { return $this->hasMany(Project::class); }
    public function maintenanceTickets() { return $this->hasMany(MaintenanceTicket::class); }
    public function warranties() { return $this->hasMany(Warranty::class); }
    public function solarSystems() { return $this->hasMany(SolarSystem::class); }
}