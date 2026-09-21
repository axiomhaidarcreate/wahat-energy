<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number', 'customer_id', 'quotation_id', 'status', 'total'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function quotation() { return $this->belongsTo(Quotation::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function invoices() { return $this->hasMany(Invoice::class); }
    public function projects() { return $this->hasMany(Project::class); }
}