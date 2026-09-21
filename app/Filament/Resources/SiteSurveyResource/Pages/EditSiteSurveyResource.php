<?php

namespace App\Filament\Resources\SiteSurveyResource\Pages;

use App\Filament\Resources\SiteSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteSurveyResource extends EditRecord
{
    protected static string $resource = SiteSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}