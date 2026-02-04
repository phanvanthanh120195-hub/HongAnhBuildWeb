<?php

namespace App\Filament\Resources\ProductReviews\Pages;

use App\Filament\Resources\ProductReviews\ProductReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductReview extends EditRecord
{
    protected static string $resource = ProductReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['customer_id'])) {
            $customer = \App\Models\Customer::find($data['customer_id']);
            $data['reviewer_name'] = $customer?->name ?? 'Khách hàng';
        } else {
            if (empty($data['reviewer_name'])) {
                $data['reviewer_name'] = 'Ẩn danh ' . \Illuminate\Support\Str::random(6);
            }
            $data['customer_id'] = null;
        }

        return $data;
    }
}
