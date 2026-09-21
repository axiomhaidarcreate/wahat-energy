<?php

namespace App\Filament\Resources\AuditLogResource\Pages;

use App\Filament\Resources\AuditLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditLogResource extends CreateRecord
{
    protected static string $resource = AuditLogResource::class;
}