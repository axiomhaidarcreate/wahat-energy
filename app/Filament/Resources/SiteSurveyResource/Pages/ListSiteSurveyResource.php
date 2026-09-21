<?php

namespace App\Filament\Resources\SiteSurveyResource\Pages;

use App\Filament\Resources\SiteSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteSurveyResource extends ListRecords
{
    protected static string $resource = SiteSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}