<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryResource extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}