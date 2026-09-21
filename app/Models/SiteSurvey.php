<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSurvey extends Model
{
    protected $fillable = [
        'project_id', 'survey_date', 'engineer_id', 'notes', 'document_path'
    ];

    protected $casts = [
        'survey_date' => 'date',
    ];

    public function project() { return $this->belongsTo(Project::class); }
    public function engineer() { return $this->belongsTo(User::class, 'engineer_id'); }
}