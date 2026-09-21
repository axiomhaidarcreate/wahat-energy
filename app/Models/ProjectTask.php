<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'status', 'assigned_to'
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
}