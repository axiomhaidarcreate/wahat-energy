<?php

namespace App\Filament\Resources\SolarSystemResource\Pages;

use App\Filament\Resources\SolarSystemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSolarSystemResource extends ListRecords
{
    protected static string $resource = SolarSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}