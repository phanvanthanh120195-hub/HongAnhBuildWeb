<?php

namespace App\Filament\Resources\CourseReviews;

use App\Filament\Resources\CourseReviews\Pages\CreateCourseReview;
use App\Filament\Resources\CourseReviews\Pages\EditCourseReview;
use App\Filament\Resources\CourseReviews\Pages\ListCourseReviews;
use App\Filament\Resources\CourseReviews\Schemas\CourseReviewForm;
use App\Filament\Resources\CourseReviews\Tables\CourseReviewsTable;
use App\Models\CourseReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CourseReviewResource extends Resource
{
    protected static ?string $model = CourseReview::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static string | \UnitEnum | null $navigationGroup = 'Education';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Đánh giá';

    protected static ?string $modelLabel = 'Đánh giá';

    protected static ?string $pluralModelLabel = 'Đánh giá';

    public static function form(Schema $schema): Schema
    {
        return CourseReviewForm::configure($schema)
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return CourseReviewsTable::configure($table);
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
            'index' => ListCourseReviews::route('/'),
            'create' => CreateCourseReview::route('/create'),
            'edit' => EditCourseReview::route('/{record}/edit'),
        ];
    }
}
