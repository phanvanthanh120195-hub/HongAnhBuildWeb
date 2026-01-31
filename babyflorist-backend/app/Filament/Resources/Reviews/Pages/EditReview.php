<?php

namespace App\Filament\Resources\Reviews\Pages;

use App\Filament\Resources\Reviews\ReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditReview extends EditRecord
{
    protected static string $resource = ReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['customer_id'])) {
            // Nếu chọn khách hàng -> LUÔN dùng tên khách hàng
            $customer = \App\Models\Customer::find($data['customer_id']);
            $data['reviewer_name'] = $customer?->name ?? 'Khách hàng';
        } else {
            // Không chọn khách hàng -> tạo tên ẩn danh nếu chưa có
            if (empty($data['reviewer_name'])) {
                $data['reviewer_name'] = 'Ẩn danh ' . \Illuminate\Support\Str::random(6);
            }
            $data['customer_id'] = null;
        }

        return $data;
    }
}
