<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'desc',
        'icon',
        'color',
        'videos',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'videos' => 'array',
        'is_active' => 'boolean',
    ];
}
