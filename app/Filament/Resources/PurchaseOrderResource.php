<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Models\PurchaseOrder;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PurchaseOrderResource extends Resource
{
    protected static ?string $model = \App\Models\PurchaseOrder::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-cart';

    protected static \UnitEnum|string|null $navigationGroup = 'المشتريات والموردين';

    protected static ?string $modelLabel = 'أمر شراء';

    protected static ?string $pluralModelLabel = 'أوامر الشراء';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('po_number')->label('رقم أمر الشراء')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('supplier_id')->label('المورد')->relationship('supplier', 'name')->required(),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'draft' => 'مسودة',
                'ordered' => 'تم الطلب',
                'received' => 'تم الاستلام',
                'cancelled' => 'ملغى',
            ])->default('draft')->required(),
            Forms\Components\TextInput::make('total_amount')->label('المبلغ الإجمالي')->numeric()->prefix('SAR'),
            Forms\Components\DatePicker::make('expected_delivery_date')->label('تاريخ التسليم المتوقع'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('po_number')->label('رقم الطلب')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('supplier.name')->label('المورد')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'gray' => 'draft',
                'warning' => 'ordered',
                'success' => 'received',
                'danger' => 'cancelled',
            ]),
            Tables\Columns\TextColumn::make('total_amount')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('expected_delivery_date')->label('تاريخ التسليم المتوقع')->date('Y-m-d'),
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
            'index' => Pages\ListPurchaseOrderResource::route('/'),
            'create' => Pages\CreatePurchaseOrderResource::route('/create'),
            'edit' => Pages\EditPurchaseOrderResource::route('/{record}/edit'),
        ];
    }
}