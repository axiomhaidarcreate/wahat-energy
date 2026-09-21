<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceTicketResource\Pages;
use App\Models\MaintenanceTicket;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MaintenanceTicketResource extends Resource
{
    protected static ?string $model = \App\Models\MaintenanceTicket::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench';

    protected static \UnitEnum|string|null $navigationGroup = 'المشاريع والصيانة';

    protected static ?string $modelLabel = 'تذكرة صيانة';

    protected static ?string $pluralModelLabel = 'تذاكر الصيانة';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('ticket_number')->label('رقم التذكرة')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('solar_system_id')->label('النظام الشمس المرتبط')->relationship('solarSystem', 'name')->searchable(),
            Forms\Components\TextInput::make('subject')->label('موضوع البلاغ / المشكلة')->required(),
            Forms\Components\Textarea::make('description')->label('تفاصيل العطل')->required(),
            Forms\Components\Select::make('status')->label('حالة التذكرة')->options([
                'open' => 'مفتوحة',
                'assigned' => 'تم تعيين فني',
                'on_the_way' => 'الفني في الطريق',
                'in_progress' => 'قيد الإصلاح',
                'resolved' => 'تم حل المشكلة',
                'closed' => 'مغلقة',
            ])->default('open')->required(),
            Forms\Components\Select::make('technician_id')->label('الفني المسؤول')->relationship('technician', 'name')->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('ticket_number')->label('رقم التذكرة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('subject')->label('الموضوع')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'danger' => 'open',
                'warning' => 'assigned',
                'info' => 'in_progress',
                'success' => 'resolved',
                'gray' => 'closed',
            ]),
            Tables\Columns\TextColumn::make('technician.name')->label('الفني'),
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
            'index' => Pages\ListMaintenanceTicketResource::route('/'),
            'create' => Pages\CreateMaintenanceTicketResource::route('/create'),
            'edit' => Pages\EditMaintenanceTicketResource::route('/{record}/edit'),
        ];
    }
}