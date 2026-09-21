<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SolarSystemResource\Pages;
use App\Models\SolarSystem;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SolarSystemResource extends Resource
{
    protected static ?string $model = \App\Models\SolarSystem::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-sun';

    protected static \UnitEnum|string|null $navigationGroup = 'الأنظمة والتقارير';

    protected static ?string $modelLabel = 'نظام طاقة شمسية';

    protected static ?string $pluralModelLabel = 'الأنظمة الشمسية المنفذة';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('اسم المحطة / النظام')->required(),
            Forms\Components\Select::make('customer_id')->label('المالك / العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('project_id')->label('المشروع المنفذ')->relationship('project', 'name')->searchable(),
            Forms\Components\TextInput::make('capacity_kw')->label('قدرة النظام (كيلوواط Peak)')->numeric()->suffix('kW'),
            Forms\Components\DatePicker::make('installation_date')->label('تاريخ التشغيل'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم النظام')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('capacity_kw')->label('السعة (kW)')->sortable(),
            Tables\Columns\TextColumn::make('installation_date')->label('تاريخ التشغيل')->date('Y-m-d'),
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
            'index' => Pages\ListSolarSystemResource::route('/'),
            'create' => Pages\CreateSolarSystemResource::route('/create'),
            'edit' => Pages\EditSolarSystemResource::route('/{record}/edit'),
        ];
    }
}