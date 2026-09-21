<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $fillable = [
        'warranty_code', 'customer_id', 'project_id', 'product_id', 'start_date', 'end_date', 'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function project() { return $this->belongsTo(Project::class); }
    public function product() { return $this->belongsTo(Product::class); }
}