<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_code', 'name', 'slug', 'customer_id', 'order_id', 'status', 'start_date', 'end_date', 'image_path', 'description', 'content'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function order() { return $this->belongsTo(Order::class); }
    public function tasks() { return $this->hasMany(ProjectTask::class); }
    public function siteSurveys() { return $this->hasMany(SiteSurvey::class); }
    public function installations() { return $this->hasMany(Installation::class); }
    public function warranties() { return $this->hasMany(Warranty::class); }
    public function solarSystems() { return $this->hasMany(SolarSystem::class); }
}