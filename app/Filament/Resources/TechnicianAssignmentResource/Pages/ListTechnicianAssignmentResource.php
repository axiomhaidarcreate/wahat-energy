<?php

namespace App\Filament\Resources\TechnicianAssignmentResource\Pages;

use App\Filament\Resources\TechnicianAssignmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTechnicianAssignmentResource extends ListRecords
{
    protected static string $resource = TechnicianAssignmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}