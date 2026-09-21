<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static \UnitEnum|string|null $navigationGroup = 'إدارة الموقع';

    protected static ?string $modelLabel = 'خدمة';

    protected static ?string $pluralModelLabel = 'الخدمات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')
                ->label('عنوان الخدمة')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->label('الرابط الدائم (Slug)')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('icon')
                ->label('أيقونة الخدمة (FontAwesome)')
                ->placeholder('مثال: fa-solar-panel')
                ->helperText('أدخل اسم أيقونة FontAwesome مثل: fa-solar-panel, fa-helmet-safety, fa-gears'),
            Forms\Components\FileUpload::make('image_path')
                ->label('صورة الخدمة (خلفية)')
                ->image()
                ->directory('services')
                ->columnSpanFull(),
            Forms\Components\Textarea::make('description')
                ->label('الوصف المختصر')
                ->helperText('يظهر هذا النص في كروت الخدمات على الموقع')
                ->rows(3)
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('محتوى الخدمة (تفصيلي)')
                ->helperText('يظهر هذا المحتوى في صفحة تفاصيل الخدمة')
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_active')
                ->label('نشط')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('الصورة')->circular(),
                Tables\Columns\TextColumn::make('title')->label('عنوان الخدمة')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('icon')->label('الأيقونة'),
                Tables\Columns\IconColumn::make('is_active')->label('نشط')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime('Y-m-d')->sortable(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
