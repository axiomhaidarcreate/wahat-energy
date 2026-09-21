<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = \App\Models\Lead::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-funnel';

    protected static \UnitEnum|string|null $navigationGroup = 'المبيعات والعملاء';

    protected static ?string $modelLabel = 'عميل محتمل';

    protected static ?string $pluralModelLabel = 'المبيعات المحتملة (Leads)';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('customer_id')->label('العميل المرتبط')->relationship('customer', 'name')->searchable(),
            Forms\Components\TextInput::make('title')->label('عنوان الفرصة')->required(),
            Forms\Components\Textarea::make('description')->label('التفاصيل'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'new' => 'جديد',
                'contacted' => 'تم التواصل',
                'qualified' => 'مؤهل',
                'lost' => 'مفقود',
                'converted' => 'تم التحويل',
            ])->default('new')->required(),
            Forms\Components\Select::make('assigned_to')->label('المسؤول')->relationship('assignedTo', 'name')->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('title')->label('العنوان')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'info' => 'new',
                'warning' => 'contacted',
                'success' => 'converted',
                'danger' => 'lost',
            ]),
            Tables\Columns\TextColumn::make('assignedTo.name')->label('المسؤول'),
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->date('Y-m-d'),
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
            'index' => Pages\ListLeadResource::route('/'),
            'create' => Pages\CreateLeadResource::route('/create'),
            'edit' => Pages\EditLeadResource::route('/{record}/edit'),
        ];
    }
}