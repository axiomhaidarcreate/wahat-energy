<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExpenseResource extends Resource
{
    protected static ?string $model = \App\Models\Expense::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static \UnitEnum|string|null $navigationGroup = 'المالية والحسابات';

    protected static ?string $modelLabel = 'مصروف';

    protected static ?string $pluralModelLabel = 'المصروفات';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('reference')->label('الرقم المرجعي / السند'),
            Forms\Components\TextInput::make('category')->label('فئة المصروف')->required(),
            Forms\Components\TextInput::make('amount')->label('المبلغ')->numeric()->prefix('SAR')->required(),
            Forms\Components\DatePicker::make('expense_date')->label('تاريخ المصروف')->required()->default(now()),
            Forms\Components\Textarea::make('description')->label('التفاصيل'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('reference')->label('المرجع')->searchable(),
            Tables\Columns\TextColumn::make('category')->label('الفئة')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('amount')->label('المبلغ')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('expense_date')->label('التاريخ')->date('Y-m-d')->sortable(),
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
            'index' => Pages\ListExpenseResource::route('/'),
            'create' => Pages\CreateExpenseResource::route('/create'),
            'edit' => Pages\EditExpenseResource::route('/{record}/edit'),
        ];
    }
}