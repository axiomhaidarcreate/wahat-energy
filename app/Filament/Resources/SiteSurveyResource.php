<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSurveyResource\Pages;
use App\Models\SiteSurvey;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSurveyResource extends Resource
{
    protected static ?string $model = \App\Models\SiteSurvey::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static \UnitEnum|string|null $navigationGroup = 'المشاريع والصيانة';

    protected static ?string $modelLabel = 'معاينة موقع';

    protected static ?string $pluralModelLabel = 'معاينات المواقع';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Select::make('project_id')->label('المشروع')->relationship('project', 'name')->required()->searchable(),
            Forms\Components\Select::make('engineer_id')->label('المهندس المعاين')->relationship('engineer', 'name')->required(),
            Forms\Components\DatePicker::make('survey_date')->label('تاريخ المعاينة')->default(now()),
            Forms\Components\Textarea::make('notes')->label('ملاحظات وقراءات المعاينة'),
            Forms\Components\FileUpload::make('document_path')->label('تقرير المعاينة (PDF/Image)')->directory('surveys'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('project.name')->label('المشروع')->searchable(),
            Tables\Columns\TextColumn::make('engineer.name')->label('المهندس المعاين'),
            Tables\Columns\TextColumn::make('survey_date')->label('تاريخ المعاينة')->date('Y-m-d'),
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
            'index' => Pages\ListSiteSurveyResource::route('/'),
            'create' => Pages\CreateSiteSurveyResource::route('/create'),
            'edit' => Pages\EditSiteSurveyResource::route('/{record}/edit'),
        ];
    }
}