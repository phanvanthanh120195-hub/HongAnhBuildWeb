<?php

namespace App\Filament\Resources\BlogCategories\Pages;

use App\Filament\Resources\BlogCategories\BlogCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogCategory extends CreateRecord
{
    protected static string $resource = BlogCategoryResource::class;

    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Tạo danh mục bài viết';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
