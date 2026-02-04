<?php

namespace App\Filament\Resources\FeaturedReview\Pages;

use App\Filament\Resources\FeaturedReview\FeaturedReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedReviews extends ListRecords
{
    protected static string $resource = FeaturedReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
