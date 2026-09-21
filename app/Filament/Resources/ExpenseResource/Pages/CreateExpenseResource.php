<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenseResource extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
}