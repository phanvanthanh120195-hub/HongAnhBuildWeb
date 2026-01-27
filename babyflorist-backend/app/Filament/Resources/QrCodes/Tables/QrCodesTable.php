<?php

namespace App\Filament\Resources\QrCodes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class QrCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('qr_image')
                    ->label('Ảnh QR')
                    ->square(),
                TextColumn::make('name')
                    ->label('Tên gợi nhớ')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bank_name')
                    ->label('Ngân hàng')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('account_number')
                    ->label('Số tài khoản')
                    ->searchable(),
                TextColumn::make('account_name')
                    ->label('Chủ tài khoản')
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->onColor('success')
                    ->offColor('gray'),
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
