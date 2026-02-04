<?php

namespace App\Filament\Resources\CourseReviews\Pages;

use App\Filament\Resources\CourseReviews\CourseReviewResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCourseReview extends CreateRecord
{
    protected static string $resource = CourseReviewResource::class;

    protected static bool $canCreateAnother = false;

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
