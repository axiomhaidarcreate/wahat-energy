<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = \App\Models\Payment::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-banknotes';

    protected static \UnitEnum|string|null $navigationGroup = 'المالية والحسابات';

    protected static ?string $modelLabel = 'دفعة مالية';

    protected static ?string $pluralModelLabel = 'سندات القبض والمدفوعات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('transaction_id')->label('رقم المعاملة / التحويل'),
            Forms\Components\Select::make('invoice_id')->label('الفاتورة')->relationship('invoice', 'invoice_number')->required()->searchable(),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\TextInput::make('amount')->label('المبلغ المدفوع')->numeric()->prefix('SAR')->required(),
            Forms\Components\Select::make('payment_method')->label('طريقة الدفع')->options([
                'cash' => 'نقداً (Cash)',
                'bank_transfer' => 'تحويل بنكي',
                'credit_card' => 'بطاقة ائتمان',
                'cheque' => 'شيك بنكي',
            ])->required(),
            Forms\Components\DatePicker::make('payment_date')->label('تاريخ الدفع')->required()->default(now()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('transaction_id')->label('رقم المعاملة')->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\TextColumn::make('invoice.invoice_number')->label('رقم الفاتورة'),
            Tables\Columns\TextColumn::make('amount')->label('المبلغ')->money('SAR')->sortable(),
            Tables\Columns\BadgeColumn::make('payment_method')->label('الطريقة'),
            Tables\Columns\TextColumn::make('payment_date')->label('التاريخ')->date('Y-m-d')->sortable(),
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
            'index' => Pages\ListPaymentResource::route('/'),
            'create' => Pages\CreatePaymentResource::route('/create'),
            'edit' => Pages\EditPaymentResource::route('/{record}/edit'),
        ];
    }
}