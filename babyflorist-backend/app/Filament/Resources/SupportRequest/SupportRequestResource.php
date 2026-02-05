<?php

namespace App\Filament\Resources\SupportRequest;

use App\Filament\Resources\SupportRequest\Pages;
use App\Filament\Resources\SupportRequest\Schemas\SupportRequestForm;
use App\Filament\Resources\SupportRequest\Tables\SupportRequestTable;
use App\Models\SupportRequest;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SupportRequestResource extends Resource
{
    protected static ?string $model = SupportRequest::class;

    protected static ?string $slug = 'support-requests';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-inbox';

    protected static string | \UnitEnum | null $navigationGroup = 'Khách hàng';

    protected static ?string $navigationLabel = 'Hỗ trợ';

    protected static ?string $modelLabel = 'Yêu cầu hỗ trợ';

    protected static ?string $pluralModelLabel = 'Danh sách yêu cầu';

    public static function form(Schema $schema): Schema
    {
        return SupportRequestForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SupportRequestTable::configure($table);
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
            'index' => Pages\ListSupportRequests::route('/'),
            'edit' => Pages\EditSupportRequest::route('/{record}/edit'),
        ];
    }
}
