<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    protected $fillable = [
        'project_id', 'scheduled_date', 'status', 'notes'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function technicianAssignments() { return $this->hasMany(TechnicianAssignment::class); }
    public function technicians()
    {
        return $this->belongsToMany(User::class, 'technician_assignments', 'installation_id', 'technician_id');
    }
}