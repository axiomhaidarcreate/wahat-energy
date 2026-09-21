<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = \App\Models\Project::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-briefcase';

    protected static \UnitEnum|string|null $navigationGroup = 'المشاريع والصيانة';

    protected static ?string $modelLabel = 'مشروع';

    protected static ?string $pluralModelLabel = 'المشاريع الهندسية';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Section::make('معلومات المشروع الأساسية')
                ->schema([
                    Forms\Components\TextInput::make('project_code')->label('كود المشروع')->required()->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('name')->label('اسم المشروع')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                    Forms\Components\TextInput::make('slug')->label('الرابط المباشر (Slug)')->unique(ignoreRecord: true),
                    Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
                    Forms\Components\Select::make('order_id')->label('طلب المبيعات المرتبط')->relationship('order', 'order_number')->searchable(),
                    Forms\Components\Select::make('status')->label('مرحلة المشروع')->options([
                        'site_survey' => 'معاينة الموقع',
                        'design' => 'التصميم والتخطيط',
                        'procurement' => 'تجهيز المواد',
                        'installation' => 'التركيب والربط',
                        'testing' => 'الفحص والاختبار',
                        'commissioning' => 'التشغيل والتسليم',
                        'completed' => 'مكتمل بنجاح',
                    ])->default('site_survey')->required(),
                    Forms\Components\DatePicker::make('start_date')->label('تاريخ البدء'),
                    Forms\Components\DatePicker::make('end_date')->label('تاريخ الانتهاء'),
                ])->columns(2),
            Forms\Components\Section::make('معلومات العرض في الموقع')
                ->schema([
                    Forms\Components\FileUpload::make('image_path')
                        ->label('صورة المشروع')
                        ->image()
                        ->directory('projects'),
                    Forms\Components\Textarea::make('description')
                        ->label('وصف مختصر (يظهر في الكرت)')
                        ->rows(3),
                    Forms\Components\RichEditor::make('content')
                        ->label('تفاصيل المشروع (يظهر في صفحة المشروع)')
                        ->columnSpanFull(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\ImageColumn::make('image_path')->label('الصورة')->circular(),
            Tables\Columns\TextColumn::make('project_code')->label('كود المشروع')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('name')->label('اسم المشروع')->searchable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('المرحلة')->colors([
                'gray' => 'site_survey',
                'info' => 'design',
                'warning' => 'installation',
                'success' => 'completed',
            ]),
            Tables\Columns\TextColumn::make('start_date')->label('البدء')->date('Y-m-d'),
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
            'index' => Pages\ListProjectResource::route('/'),
            'create' => Pages\CreateProjectResource::route('/create'),
            'edit' => Pages\EditProjectResource::route('/{record}/edit'),
        ];
    }
}