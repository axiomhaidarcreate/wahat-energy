<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = \App\Models\Customer::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static \UnitEnum|string|null $navigationGroup = 'المبيعات والعملاء';

    protected static ?string $modelLabel = 'عميل';

    protected static ?string $pluralModelLabel = 'العملاء';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('اسم العميل')->required(),
            Forms\Components\TextInput::make('email')->label('البريد الإلكتروني')->email(),
            Forms\Components\TextInput::make('phone')->label('رقم الهاتف')->tel(),
            Forms\Components\TextInput::make('company_name')->label('اسم الشركة'),
            Forms\Components\TextInput::make('tax_number')->label('الرقم الضريبي'),
            Forms\Components\Select::make('type')->label('نوع العميل')->options([
                'individual' => 'فردي',
                'corporate' => 'شركات',
            ])->default('individual')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('اسم العميل')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('company_name')->label('الشركة')->searchable(),
            Tables\Columns\TextColumn::make('phone')->label('الهاتف')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('البريد')->searchable(),
            Tables\Columns\BadgeColumn::make('type')->label('النوع')->formatStateUsing(fn ($state) => $state === 'corporate' ? 'شركة' : 'فرد'),
            Tables\Columns\TextColumn::make('created_at')->label('تاريخ التسجيل')->date('Y-m-d'),
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
            'index' => Pages\ListCustomerResource::route('/'),
            'create' => Pages\CreateCustomerResource::route('/create'),
            'edit' => Pages\EditCustomerResource::route('/{record}/edit'),
        ];
    }
}