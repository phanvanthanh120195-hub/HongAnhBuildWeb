<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('sku')
                    ->label('MSP')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->wrap(),
                ImageColumn::make('thumbnail')
                    ->label('Hình ảnh')
                    ->disk('public')
                    ->defaultImageUrl(url('/images/placeholder.png')),
                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Giá bán')
                    ->numeric(decimalPlaces: 0)
                    ->suffix(' ₫')
                    ->sortable(),
                TextColumn::make('sale_price')
                    ->label('Giá KM')
                    ->numeric(decimalPlaces: 0)
                    ->suffix(' ₫')
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Tồn kho')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('label')
                    ->label('Nhãn')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'sale' => 'danger',
                        'hot' => 'warning',
                        'new' => 'success',
                        default => 'gray',
                    }),
                ToggleColumn::make('status')
                    ->label('Trạng thái')
                     ->afterStateUpdated(function ($record, $state) {
                        // Ensure state is saved as 'active'/'inactive'
                        // ToggleColumn passes boolean state here
                        $record->update(['status' => $state ? 'active' : 'inactive']);
                    })
                    ->updateStateUsing(function ($record, $state) {
                        // This handles the immediate update action
                        $newState = $state ? 'active' : 'inactive';
                        $record->update(['status' => $newState]);
                        return $newState;
                    })
                    ->getStateUsing(fn ($record) => $record->status === 'active'),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y')
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
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
