<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationResource\Pages;
use App\Models\Quotation;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuotationResource extends Resource
{
    protected static ?string $model = \App\Models\Quotation::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static \UnitEnum|string|null $navigationGroup = 'المبيعات والعملاء';

    protected static ?string $modelLabel = 'عرض سعر';

    protected static ?string $pluralModelLabel = 'عروض الأسعار';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('quotation_number')->label('رقم عرض السعر')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('customer_id')->label('العميل')->relationship('customer', 'name')->required()->searchable(),
            Forms\Components\Select::make('user_id')->label('معد العرض')->relationship('user', 'name'),
            Forms\Components\Select::make('status')->label('الحالة')->options([
                'draft' => 'مسودة',
                'sent' => 'تم الإرسال',
                'approved' => 'موافق عليه',
                'rejected' => 'مرفوض',
                'converted' => 'محول إلى طلب',
            ])->default('draft')->required(),
            Forms\Components\TextInput::make('subtotal')->label('المجموع الفرعي')->numeric()->prefix('SAR'),
            Forms\Components\TextInput::make('discount')->label('الخصم')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('tax')->label('الضريبة (15%)')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('installation_fee')->label('رسوم التركيب')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('transport_fee')->label('رسوم النقل')->numeric()->prefix('SAR')->default(0),
            Forms\Components\TextInput::make('total')->label('الإجمالي النهائي')->numeric()->prefix('SAR')->required(),
            Forms\Components\DatePicker::make('valid_until')->label('صالح حتى'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('quotation_number')->label('رقم العرض')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('العميل')->searchable(),
            Tables\Columns\BadgeColumn::make('status')->label('الحالة')->colors([
                'gray' => 'draft',
                'info' => 'sent',
                'success' => 'approved',
                'danger' => 'rejected',
                'amber' => 'converted',
            ]),
            Tables\Columns\TextColumn::make('total')->label('الإجمالي')->money('SAR')->sortable(),
            Tables\Columns\TextColumn::make('valid_until')->label('صالح حتى')->date('Y-m-d'),
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
            'index' => Pages\ListQuotationResource::route('/'),
            'create' => Pages\CreateQuotationResource::route('/create'),
            'edit' => Pages\EditQuotationResource::route('/{record}/edit'),
        ];
    }
}