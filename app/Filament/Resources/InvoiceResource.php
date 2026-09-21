<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = \App\Models\Invoice::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-receipt-percent';

    protected static \UnitEnum|string|null $navigationGroup = 'المالية والحسابات';

    protected static ?string $modelLabel = 'فاتورة';

    protected static ?string $pluralModelLabel = 'الفواتير';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('invoice_number')->label('رقم الفاتورة')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('order_id')->label('الطلب المرتبط')->relationship('order', 'order_number')->searchable(),
            Forms\Components\DatePicker::make('issue_date')->label('تاريخ الإصدار')->required()->default(now()),
            Forms\Components\DatePicker::make('due_date')->label('تاريخ الاستحقاق'),
            Forms\Components\TextInput::make('total')->label('إجمالي الفاتورة')->numeric()->prefix('SAR')->required(),
            Forms\Components\TextInput::make('paid')->label('المبلغ المدفوع')->numeric()->prefix('SAR')->default(0),
            Forms\Components\Select::make('status')->label('حالة الفاتورة')->options([
                'unpaid' => 'غير مدفوعة',
                'partial' => 'مدفوعة جزئياً',
                'paid' => 'مدفوعة بالكامل',
                'cancelled' => 'ملغاة',
            ])->default('unpaid')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('invoice_number')->label('رقم الفاتورة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'danger' => 'unpaid',
                'warning' => 'partial',
                'success' => 'paid',
                'gray' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('paid')->label('المدفوع')->money('SAR'),
            Tables\Columns\TextColumn::make('issue_date')->label('تاريخ الإصدار')->date('Y-m-d'),
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
            'index' => Pages\ListInvoiceResource::route('/'),
            'create' => Pages\CreateInvoiceResource::route('/create'),
            'edit' => Pages\EditInvoiceResource::route('/{record}/edit'),
        ];
    }
}