<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TechnicianAssignmentResource\Pages;
use App\Models\TechnicianAssignment;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TechnicianAssignmentResource extends Resource
{
    protected static ?string $model = \App\Models\TechnicianAssignment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-identification';

    protected static \UnitEnum|string|null $navigationGroup = 'المشاريع والصيانة';

    protected static ?string $modelLabel = 'تكليف فني';

    protected static ?string $pluralModelLabel = 'تكليفات الفنيين';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('installation_id')->label('مهمة التركيب')->relationship('installation', 'id')->required(),
            Forms\Components\Select::make('technician_id')->label('الفني')->relationship('technician', 'name')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('installation.project.name')->label('المشروع'),
            Tables\Columns\TextColumn::make('technician.name')->label('اسم الفني')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ التكليف')->dateTime('Y-m-d H:i'),
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
            'index' => Pages\ListTechnicianAssignmentResource::route('/'),
            'create' => Pages\CreateTechnicianAssignmentResource::route('/create'),
            'edit' => Pages\EditTechnicianAssignmentResource::route('/{record}/edit'),
        ];
    }
}