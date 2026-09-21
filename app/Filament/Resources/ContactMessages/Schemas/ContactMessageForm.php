<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->disabled(),
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->disabled(),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->disabled(),
                TextInput::make('subject')
                    ->label('الموضوع')
                    ->disabled(),
                Textarea::make('message')
                    ->label('نص الرسالة')
                    ->disabled()
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('تم القراءة؟')
                    ->required(),
            ]);
    }
}
