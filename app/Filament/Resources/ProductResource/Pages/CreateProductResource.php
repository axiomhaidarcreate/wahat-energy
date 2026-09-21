<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductResource extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}