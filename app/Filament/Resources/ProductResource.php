<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = \App\Models\Product::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cube';

    protected static \UnitEnum|string|null $navigationGroup = 'المستودعات والمنتجات';

    protected static ?string $modelLabel = 'منتج';

    protected static ?string $pluralModelLabel = 'المنتجات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('اسم المنتج')->required(),
            Forms\Components\TextInput::make('slug')->label('الرابط المباشر (Slug)')->required(),
            Forms\Components\TextInput::make('sku')->label('رمز المنتج (SKU)')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('category_id')->label('القسم')->relationship('category', 'name')->required()->searchable(),
            Forms\Components\Select::make('brand_id')->label('العلامة التجارية')->relationship('brand', 'name')->searchable(),
            Forms\Components\TextInput::make('price')->label('سعر البيع')->numeric()->prefix('SAR')->required(),
            Forms\Components\TextInput::make('cost')->label('التكلفة')->numeric()->prefix('SAR'),
            Forms\Components\Toggle::make('is_active')->label('نشط')->default(true),
            Forms\Components\Textarea::make('description')->label('الوصف')->columnSpanFull(),
            Forms\Components\Repeater::make('images')
                ->relationship('images')
                ->label('صور المنتج')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('الصورة')
                        ->image()
                        ->directory('products')
                        ->required(),
                    Forms\Components\Toggle::make('is_primary')
                        ->label('تعيين كصورة رئيسية')
                        ->default(false),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم المنتج')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('sku')->label('SKU')->searchable(),
            Tables\Columns\TextColumn::make('category.name')->label('القسم')->sortable(),
            Tables\Columns\TextColumn::make('brand.name')->label('العلامة التجارية'),
            Tables\Columns\TextColumn::make('price')->label('سعر البيع')->money('SAR')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
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
            'index' => Pages\ListProductResource::route('/'),
            'create' => Pages\CreateProductResource::route('/create'),
            'edit' => Pages\EditProductResource::route('/{record}/edit'),
        ];
    }
}