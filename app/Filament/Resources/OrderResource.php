<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = \App\Models\Order::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static \UnitEnum|string|null $navigationGroup = 'المبيعات والعملاء';

    protected static ?string $modelLabel = 'طلب مبيعات';

    protected static ?string $pluralModelLabel = 'طلبات المبيعات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('order_number')->label('رقم الطلب')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('quotation_id')->label('عرض السعر المرتبط')->relationship('quotation', 'quotation_number')->searchable(),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'pending' => 'قيد الانتظار',
                'processing' => 'قيد التجهيز',
                'completed' => 'مكتمل',
                'cancelled' => 'ملغى',
            ])->default('pending')->required(),
            Forms\Components\TextInput::make('total')->label('المبلغ الإجمالي')->numeric()->prefix('SAR')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('order_number')->label('رقم الطلب')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'warning' => 'pending',
                'info' => 'processing',
                'success' => 'completed',
                'danger' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i'),
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
            'index' => Pages\ListOrderResource::route('/'),
            'create' => Pages\CreateOrderResource::route('/create'),
            'edit' => Pages\EditOrderResource::route('/{record}/edit'),
        ];
    }
}