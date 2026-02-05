<?php

namespace App\Filament\Resources\SupportRequest\Pages;

use App\Filament\Resources\SupportRequest\SupportRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSupportRequests extends ListRecords
{
    protected static string $resource = SupportRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(), // Admin usually doesn't create support requests
        ];
    }
}
