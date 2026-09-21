<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = \App\Models\Setting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة النظام والأمان';

    protected static ?string $modelLabel = 'إعداد';

    protected static ?string $pluralModelLabel = 'إعدادات النظام';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('key')->label('مفتاح الإعداد')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('group')->label('المجموعة')->default('general')->required(),
            Forms\Components\Textarea::make('value')->label('القيمة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('key')->label('المفتاح')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('group')->label('المجموعة')->sortable(),
            Tables\Columns\TextColumn::make('value')->label('القيمة')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettingResource::route('/'),
            'create' => Pages\CreateSettingResource::route('/create'),
            'edit' => Pages\EditSettingResource::route('/{record}/edit'),
        ];
    }
}