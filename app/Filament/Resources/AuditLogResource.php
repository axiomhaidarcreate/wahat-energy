<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditLogResource\Pages;
use App\Models\AuditLog;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AuditLogResource extends Resource
{
    protected static ?string $model = \App\Models\AuditLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة النظام والأمان';

    protected static ?string $modelLabel = 'سجل تدقيق';

    protected static ?string $pluralModelLabel = 'سجلات التدقيق والأمان';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('user_id')->label('المستخدم')->relationship('user', 'name'),
            Forms\Components\TextInput::make('action')->label('الحدث / الإجراء'),
            Forms\Components\TextInput::make('model_type')->label('نوع الكائن'),
            Forms\Components\TextInput::make('ip_address')->label('عنوان IP'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ والوقت')->dateTime('Y-m-d H:i:s')->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('المستخدم')->searchable(),
            Tables\Columns\BadgeColumn::make('action')->label('الإجراء')->color('amber'),
            Tables\Columns\TextColumn::make('model_type')->label('الكائن'),
            Tables\Columns\TextColumn::make('ip_address')->label('IP Address'),
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
            'index' => Pages\ListAuditLogResource::route('/'),
            'create' => Pages\CreateAuditLogResource::route('/create'),
            'edit' => Pages\EditAuditLogResource::route('/{record}/edit'),
        ];
    }
}