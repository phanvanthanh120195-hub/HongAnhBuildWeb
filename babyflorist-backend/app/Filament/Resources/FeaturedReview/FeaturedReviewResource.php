<?php

namespace App\Filament\Resources\FeaturedReview;

use App\Filament\Resources\FeaturedReview\Pages;
use App\Filament\Resources\FeaturedReview\Schemas\FeaturedReviewForm;
use App\Filament\Resources\FeaturedReview\Tables\FeaturedReviewsTable;
use App\Models\FeaturedReview;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class FeaturedReviewResource extends Resource
{
    protected static ?string $model = FeaturedReview::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-star';

    protected static string | \UnitEnum | null $navigationGroup = 'Khách hàng';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Đánh giá nổi bật';

    protected static ?string $slug = 'featured-reviews';

    public static function form(Schema $schema): Schema
    {
        return FeaturedReviewForm::configure($schema)->columns(1);
    }

    public static function table(Table $table): Table
    {
        return FeaturedReviewsTable::configure($table);
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
            'index' => Pages\ListFeaturedReviews::route('/'),
            'create' => Pages\CreateFeaturedReview::route('/create'),
            'edit' => Pages\EditFeaturedReview::route('/{record}/edit'),
        ];
    }
}
