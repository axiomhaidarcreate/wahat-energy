<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockMovementResource\Pages;
use App\Models\StockMovement;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StockMovementResource extends Resource
{
    protected static ?string $model = \App\Models\StockMovement::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static \UnitEnum|string|null $navigationGroup = 'المستودعات والمنتجات';

    protected static ?string $modelLabel = 'حركة مخزون';

    protected static ?string $pluralModelLabel = 'حركات المخزون';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('product_id')->label('المنتج')->relationship('product', 'name')->required(),
            Forms\Components\Select::make('warehouse_id')->label('المستودع')->relationship('warehouse', 'name')->required(),
            Forms\Components\Select::make('type')->label('نوع الحركة')->options([
                'purchase' => 'شراء (إدخال)',
                'sale' => 'بيع (إخراج)',
                'installation' => 'تركيب مشروع',
                'return' => 'إرجاع',
                'adjustment' => 'تسوية مخزنية',
                'damage' => 'تالف',
            ])->required(),
            Forms\Components\TextInput::make('quantity')->label('الكمية')->numeric()->required(),
            Forms\Components\Select::make('user_id')->label('بواسطة')->relationship('user', 'name')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i')->sortable(),
            Tables\Columns\TextColumn::make('product.name')->label('المنتج')->searchable(),
            Tables\Columns\TextColumn::make('warehouse.name')->label('المستودع'),
            Tables\Columns\BadgeColumn::make('type')->label('نوع الحركة'),
            Tables\Columns\TextColumn::make('quantity')->label('الكمية')->sortable(),
            Tables\Columns\TextColumn::make('user.name')->label('المستخدم'),
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
            'index' => Pages\ListStockMovementResource::route('/'),
            'create' => Pages\CreateStockMovementResource::route('/create'),
            'edit' => Pages\EditStockMovementResource::route('/{record}/edit'),
        ];
    }
}