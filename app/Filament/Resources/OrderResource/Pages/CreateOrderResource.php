<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderResource extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}