<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentResource extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}