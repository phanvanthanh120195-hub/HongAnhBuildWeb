<?php

namespace App\Filament\Resources\BlogComments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class BlogCommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('blogPost.title')
                    ->label('Bài viết')
                    ->limit(25)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->label('Người bình luận')
                    ->sortable()
                    ->searchable(),
                
                \Filament\Tables\Columns\TextColumn::make('customer.customer_type')
                    ->label('Loại')
                    ->formatStateUsing(fn (string $state): string => $state === 'admin' ? 'Admin' : 'Khách hàng')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'admin' ? 'success' : 'info')
                    ->sortable(),
                    
                TextColumn::make('content')
                    ->label('Nội dung')
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        return $column->getState();
                    }),
                TextColumn::make('parent.id')
                    ->label('Reply')
                    ->formatStateUsing(fn ($state) => $state ? "#{$state}" : '-')
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_approved')
                    ->label('Đã duyệt'),
                TextColumn::make('created_at')
                    ->label('Ngày tạo')
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
