<?php

namespace App\Filament\Resources\FeaturedReview\Pages;

use App\Filament\Resources\FeaturedReview\FeaturedReviewResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedReview extends CreateRecord
{
    protected static string $resource = FeaturedReviewResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
