<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryCategoryResource\Pages;
use App\Models\GalleryCategory;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryCategoryResource extends Resource
{
    protected static ?string $model = GalleryCategory::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة الموقع';

    protected static ?string $modelLabel = 'قسم معرض';

    protected static ?string $pluralModelLabel = 'أقسام المعرض';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->label('عنوان القسم')
                ->required(),
            Forms\Components\TextInput::make('subtitle')
                ->label('العنوان الفرعي'),
            Forms\Components\Textarea::make('desc')
                ->label('وصف القسم')
                ->rows(3)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('icon')
                ->label('أيقونة القسم (FontAwesome)')
                ->placeholder('مثال: fa-solar-panel'),
            Forms\Components\ColorPicker::make('color')
                ->label('اللون المميز'),
            Forms\Components\TextInput::make('sort_order')
                ->label('الترتيب')
                ->numeric()
                ->default(0),
            Forms\Components\Toggle::make('is_active')
                ->label('نشط')
                ->default(true),
            Forms\Components\Repeater::make('videos')
                ->label('الفيديوهات')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('عنوان الفيديو')
                        ->required(),
                    Forms\Components\TextInput::make('url')
                        ->label('رابط الفيديو (YouTube أو غيره)')
                        ->url()
                        ->required(),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->defaultItems(1)
                ->addActionLabel('إضافة فيديو'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('عنوان القسم')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('icon')->label('الأيقونة'),
                Tables\Columns\TextColumn::make('sort_order')->label('الترتيب')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
            ])
            ->defaultSort('sort_order')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryCategories::route('/'),
            'create' => Pages\CreateGalleryCategory::route('/create'),
            'edit' => Pages\EditGalleryCategory::route('/{record}/edit'),
        ];
    }
}
