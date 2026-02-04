<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make([
                    'default' => 1,
                    'lg' => 12,
                ])->schema([
                    // LEFT COLUMN (Main Info)
                    Group::make()
                        ->schema([
                            Section::make('Thông tin sản phẩm')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Tên sản phẩm')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                            // Auto-generate Slug
                                            if ($state) {
                                                $set('slug', Str::slug($state));
                                            }
                                            
                                            // Auto-generate SKU if empty
                                            if ($state && empty($get('sku'))) {
                                                $initials = collect(explode(' ', $state))
                                                    ->map(fn ($word) => Str::upper(Str::substr($word, 0, 1)))
                                                    ->join('');
                                                $random = mt_rand(100000, 999999);
                                                $sku = 'M' . $initials . '_' . $random;
                                                $set('sku', $sku);
                                            }
                                        }),

                                    TextInput::make('slug')
                                        ->label('Đường dẫn (Slug)')
                                        ->disabled()
                                        ->dehydrated(),

                                    Grid::make(2)->schema([
                                        Select::make('product_category_id')
                                            ->label('Danh mục')
                                            ->relationship('product_category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->default(null),

                                        Select::make('label')
                                            ->label('Nhãn')
                                            ->options([
                                                'sale' => 'Sale',
                                                'hot' => 'Hot',
                                                'new' => 'New',
                                            ])
                                            ->default(null),
                                    ]),
                                    
                                    TextInput::make('sku')
                                        ->label('Mã sản phẩm (SKU)')
                                        ->placeholder('Tự động tạo nếu để trống')
                                        ->dehydrated()
                                        ->unique(ignoreRecord: true)
                                        ->helperText('Để trống sẽ tự động tạo mã sản phẩm'),

                                    FileUpload::make('thumbnail')
                                        ->label('Hình ảnh sản phẩm')
                                        ->image()
                                        ->disk('public')
                                        ->directory('product-thumbnails')
                                        ->columnSpanFull(),

                                    Textarea::make('description')
                                        ->label('Mô tả')
                                        ->rows(5)
                                        ->default(null)
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 8,
                        ]),

                    // RIGHT COLUMN (Settings)
                    Group::make()
                        ->schema([
                            Section::make('Trạng thái')
                                ->schema([
                                    Toggle::make('is_featured')
                                        ->label('Sản phẩm nổi bật')
                                        ->helperText('Sản phẩm sẽ được hiển thị ở mục nổi bật trang chủ')
                                        ->default(false)
                                        ->onColor('success')
                                        ->offColor('gray'),

                                    Toggle::make('is_active')
                                        ->label('Hiển thị')
                                        ->helperText('Bật để hiển thị sản phẩm')
                                        ->default(true)
                                        ->inline(false),
                                ]),

                            Section::make('Giá & Kho')
                                ->schema([
                                    TextInput::make('price')
                                        ->label('Giá bán')
                                        ->required()
                                        ->suffix('₫')
                                        ->live(onBlur: true)
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0) : null)
                                        // Remove 'numeric' validation to allow commas
                                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                            $discount = (float) $get('discount_percent');
                                            if ($state) {
                                                // Strip commas for calculation
                                                $numericPrice = (float) str_replace(',', '', $state);
                                                
                                                // Re-format the input with commas
                                                $set('price', number_format($numericPrice));

                                                if ($discount > 0) {
                                                    $salePrice = $numericPrice * (1 - ($discount / 100));
                                                    $set('sale_price', number_format($salePrice));
                                                }
                                            }
                                        })
                                        ->dehydrateStateUsing(fn ($state) => (float) str_replace(',', '', $state)),

                                    TextInput::make('discount_percent')
                                        ->label('Giảm giá (%)')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->formatStateUsing(function (Get $get) {
                                            $price = $get('price');
                                            $salePrice = $get('sale_price');

                                            if ($price && $salePrice) {
                                              $numericPrice = (float) str_replace(',', '', $price);
                                              $numericSalePrice = (float) str_replace(',', '', $salePrice);
                                              
                                              if ($numericPrice > 0) {
                                                  return round((($numericPrice - $numericSalePrice) / $numericPrice) * 100, 2);
                                              }
                                            }
                                            return null;
                                        })
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                            $priceState = $get('price');
                                            $price = (float) str_replace(',', '', $priceState); // Strip commas
                                            
                                            if ($price > 0 && $state !== null) {
                                                $discount = (float) $state;
                                                $salePrice = $price * (1 - ($discount / 100));
                                                $set('sale_price', number_format($salePrice));
                                            }
                                        }),

                                    TextInput::make('sale_price')
                                        ->label('Giá khuyến mãi')
                                        ->suffix('₫')
                                        ->default(null)
                                        ->formatStateUsing(fn ($state) => $state ? number_format($state, 0) : null)
                                        ->dehydrateStateUsing(fn ($state) => $state ? (float) str_replace(',', '', $state) : null),

                                    TextInput::make('stock')
                                        ->label('Tồn kho')
                                        ->required()
                                        ->numeric()
                                        ->default(0),
                                ]),
                        ])
                        ->columnSpan([
                            'default' => 12,
                            'lg' => 4,
                        ]),
                ]),
            ]);
    }
}
