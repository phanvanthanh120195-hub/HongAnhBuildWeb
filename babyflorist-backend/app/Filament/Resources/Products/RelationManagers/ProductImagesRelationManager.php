<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ProductImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Ảnh sản phẩm';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_url')
                    ->label('Ảnh')
                    ->image()
                    ->directory('product-images')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_primary')
                    ->label('Ảnh chính')
                    ->default(false),
                TextInput::make('sort_order')
                    ->label('Thứ tự hiển thị')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image_url')
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Ảnh'),
                IconColumn::make('is_primary')
                    ->label('Ảnh chính')
                    ->boolean()
                    ->inline(false),
                TextColumn::make('sort_order')
                    ->label('Thứ tự')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->createAnother(false),
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
