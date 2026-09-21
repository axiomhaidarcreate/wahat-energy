<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerResource extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}