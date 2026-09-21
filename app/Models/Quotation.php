<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'quotation_number', 'customer_id', 'user_id', 'status', 'subtotal',
        'discount', 'tax', 'installation_fee', 'transport_fee', 'total', 'valid_until'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'installation_fee' => 'decimal:2',
        'transport_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'valid_until' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(QuotationItem::class); }
    public function orders() { return $this->hasMany(Order::class); }
}