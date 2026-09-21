<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstallationResource\Pages;
use App\Models\Installation;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InstallationResource extends Resource
{
    protected static ?string $model = \App\Models\Installation::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static \UnitEnum|string|null $navigationGroup = 'المشاريع والصيانة';

    protected static ?string $modelLabel = 'عملية تركيب';

    protected static ?string $pluralModelLabel = 'جدولة التركيبات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('project_id')->label('المشروع')->relationship('project', 'name')->required(),
            Forms\Components\DatePicker::make('scheduled_date')->label('التاريخ المحدد للتركيب'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'pending' => 'قيد الانتظار',
                'in_progress' => 'جاري التركيب',
                'completed' => 'تم التركيب',
            ])->default('pending')->required(),
            Forms\Components\Select::make('technicians')->label('الفنيين المكلفين')->relationship('technicians', 'name')->multiple()->preload(),
            Forms\Components\Textarea::make('notes')->label('ملاحظات التركيب'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('project.name')->label('المشروع')->searchable(),
            Tables\Columns\TextColumn::make('scheduled_date')->label('التاريخ')->date('Y-m-d')->sortable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'warning' => 'pending',
                'info' => 'in_progress',
                'success' => 'completed',
            ]),
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
            'index' => Pages\ListInstallationResource::route('/'),
            'create' => Pages\CreateInstallationResource::route('/create'),
            'edit' => Pages\EditInstallationResource::route('/{record}/edit'),
        ];
    }
}