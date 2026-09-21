<?php

namespace App\Filament\Widgets;

use App\Models\Stock;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockTableWidget extends BaseWidget
{
    protected static ?string $heading = 'تنبيهات المخزون المنخفض (أقل من 10 قطع)';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Stock::query()->where('quantity', '<', 10)->with(['product', 'warehouse'])
            )
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('اسم المنتج')->searchable(),
                Tables\Columns\TextColumn::make('product.sku')->label('SKU'),
                Tables\Columns\TextColumn::make('warehouse.name')->label('المستودع'),
                Tables\Columns\BadgeColumn::make('quantity')
                    ->label('الكمية المتبقية')
                    ->color('danger'),
            ]);
    }
}
