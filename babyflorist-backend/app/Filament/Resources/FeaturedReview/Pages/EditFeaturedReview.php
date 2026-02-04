<?php

namespace App\Filament\Resources\FeaturedReview\Pages;

use App\Filament\Resources\FeaturedReview\FeaturedReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedReview extends EditRecord
{
    protected static string $resource = FeaturedReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
