<?php

namespace App\Filament\Resources\CourseEnrollments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CourseEnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Học viên')
                    ->searchable()
                    ->sortable()
                    ->html()
                    ->formatStateUsing(fn ($state, $record) => $record->is_active ? $state : "<del class='opacity-50'>{$state}</del>"),
                TextColumn::make('course.name')
                    ->label('Khóa học')
                    ->searchable()
                    ->sortable()
                    ->html()
                    ->formatStateUsing(fn ($state, $record) => $record->is_active ? $state : "<del class='opacity-50'>{$state}</del>"),
                TextColumn::make('purchased_at')
                    ->label('Ngày đăng ký')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Trạng thái')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
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
