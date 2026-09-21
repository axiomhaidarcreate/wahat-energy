<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Models\Stock;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StockResource extends Resource
{
    protected static ?string $model = \App\Models\Stock::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-archive-box';

    protected static \UnitEnum|string|null $navigationGroup = 'المستودعات والمنتجات';

    protected static ?string $modelLabel = 'مخزون';

    protected static ?string $pluralModelLabel = 'جرد المخزون';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('product_id')->label('المنتج')->relationship('product', 'name')->required()->searchable(),
            Forms\Components\Select::make('warehouse_id')->label('المستودع')->relationship('warehouse', 'name')->required(),
            Forms\Components\TextInput::make('quantity')->label('الكمية المتاحة')->numeric()->required()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('product.name')->label('المنتج')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('product.sku')->label('SKU')->searchable(),
            Tables\Columns\TextColumn::make('warehouse.name')->label('المستودع')->sortable(),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية الحالية')->sortable()->badge()->color(fn ($state) => $state < 10 ? 'danger' : 'success'),
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
            'index' => Pages\ListStockResource::route('/'),
            'create' => Pages\CreateStockResource::route('/create'),
            'edit' => Pages\EditStockResource::route('/{record}/edit'),
        ];
    }
}