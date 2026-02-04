<?php

namespace App\Filament\Resources\Customers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CustomerTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                ImageColumn::make('avatar')
                    ->label('Ảnh đại diện')
                    ->circular()
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=FFFFFF&background=020617'),

                TextColumn::make('name')
                    ->label('Họ tên')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable(),

                \Filament\Tables\Columns\TextColumn::make('customer_type')
                    ->label('Loại')
                    ->formatStateUsing(fn (string $state): string => $state === 'admin' ? 'Admin' : 'Khách hàng')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'admin' ? 'success' : 'info')
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('SĐT')
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Trạng thái'),

                TextColumn::make('created_at')
                    ->label('Ngày đăng ký')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
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
