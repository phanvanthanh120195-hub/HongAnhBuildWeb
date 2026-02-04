<?php

namespace App\Filament\Resources\FeaturedReview\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FeaturedReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('display_order')
                    ->label('Vị trí')
                    ->sortable(),

                TextColumn::make('source_type')
                    ->label('Nguồn')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'product' => 'success',
                        'course' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'product' => '🛍 Sản phẩm',
                        'course' => '🎓 Khóa học',
                        default => $state,
                    }),

                TextColumn::make('content')
                    ->label('Nội dung')
                    ->limit(40)
                    ->tooltip(fn($record) => $record->content),

                ImageColumn::make('display_avatar')
                    ->label('Avatar')
                    ->circular()
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->display_name ?? 'User')),

                TextColumn::make('display_name')
                    ->label('Tên hiển thị')
                    ->description(fn($record) => $record->display_label)
                    ->getStateUsing(fn($record) => $record->display_name ?: ($record->review?->customer->name ?? 'N/A'))
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Hiển thị'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->iconButton(),
                DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
