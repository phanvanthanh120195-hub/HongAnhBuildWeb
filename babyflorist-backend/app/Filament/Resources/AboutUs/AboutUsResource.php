<?php

namespace App\Filament\Resources\AboutUs;

use App\Filament\Resources\AboutUs\Pages\CreateAboutUs;
use App\Filament\Resources\AboutUs\Pages\EditAboutUs;
use App\Filament\Resources\AboutUs\Pages\ListAboutUs;
use App\Filament\Resources\AboutUs\Schemas\AboutUsForm;
use App\Filament\Resources\AboutUs\Tables\AboutUsTable;
use App\Models\AboutUs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Về chúng tôi';

    protected static ?string $modelLabel = 'Về chúng tôi';

    protected static ?string $pluralModelLabel = 'Về chúng tôi';

    public static function form(Schema $schema): Schema
    {
        return AboutUsForm::configure($schema)->columns(1);
    }

    public static function table(Table $table): Table
    {
        return AboutUsTable::configure($table);
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
            'index' => ListAboutUs::route('/'),
            'create' => CreateAboutUs::route('/create'),
            'edit' => EditAboutUs::route('/{record}/edit'),
        ];
    }
}
