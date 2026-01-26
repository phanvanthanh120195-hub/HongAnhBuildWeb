<?php

namespace App\Filament\Resources\Vouchers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class VouchersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Mã giảm giá')
                    ->searchable(),
                TextColumn::make('discount_percentage')
                    ->label('% Giảm giá')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('apply_to')
                    ->label('Áp dụng cho')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'product' => 'info',
                        'course' => 'warning',
                        'category' => 'danger',
                        'all_orders' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('usage_limit')
                    ->label('Giới hạn sử dụng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('used_count')
                    ->label('Đã sử dụng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('valid_from')
                    ->label('Hiệu lực từ')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('valid_to')
                    ->label('Hiệu lực đến')
                    ->date('d/m/Y')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Trạng thái'),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
