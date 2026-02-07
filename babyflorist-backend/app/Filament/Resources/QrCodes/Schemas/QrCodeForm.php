<?php

namespace App\Filament\Resources\QrCodes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QrCodeForm
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
                                    Section::make('Thông tin tài khoản')
                                        ->schema([
                                            TextInput::make('name')
                                                ->label('Tên gợi nhớ')
                                                ->placeholder('Ví dụ: Tài khoản chính'),

                                            Grid::make([
                                                'default' => 1,
                                                'lg' => 2,
                                            ])->schema([
                                                        Select::make('bank_name')
                                                            ->label('Ngân hàng')
                                                            ->options([
                                                                'Vietcombank' => 'Vietcombank',
                                                                'VietinBank' => 'VietinBank',
                                                                'BIDV' => 'BIDV',
                                                                'Agribank' => 'Agribank',
                                                                'Techcombank' => 'Techcombank',
                                                                'MBBank' => 'MBBank',
                                                                'ACB' => 'ACB',
                                                                'VPBank' => 'VPBank',
                                                                'TPBank' => 'TPBank',
                                                                'Sacombank' => 'Sacombank',
                                                                'HDBank' => 'HDBank',
                                                                'VIB' => 'VIB',
                                                                'MSB' => 'MSB',
                                                                'SHB' => 'SHB',
                                                                'SeABank' => 'SeABank',
                                                                'OCB' => 'OCB',
                                                                'Eximbank' => 'Eximbank',
                                                                'LienVietPostBank' => 'LienVietPostBank',
                                                                'Cake' => 'Cake by VPBank',
                                                                'Timo' => 'Timo Digital Bank',
                                                                'ViettelMoney' => 'Viettel Money',
                                                                'VNPay' => 'VNPay',
                                                                'Momo' => 'Momo',
                                                                'ZaloPay' => 'ZaloPay',
                                                            ])
                                                            ->searchable()
                                                            ->required()
                                                            ->placeholder('Chọn ngân hàng'),

                                                        TextInput::make('account_number')
                                                            ->label('Số tài khoản')
                                                            ->required()
                                                            ->placeholder('Ví dụ: 0123456789'),
                                                    ]),

                                            TextInput::make('account_name')
                                                ->label('Chủ tài khoản')
                                                ->required()
                                                ->placeholder('Ví dụ: NGUYEN VAN A'),

                                            TextInput::make('template_content')
                                                ->label('Nội dung chuyển khoản mẫu')
                                                ->helperText('Nội dung sẽ được tự động điền khi quét QR. Ví dụ: THANHTOAN DONHANG'),

                                            Textarea::make('description')
                                                ->label('Mô tả thêm')
                                                ->rows(3),
                                        ]),
                                ])
                                ->columnSpan([
                                    'default' => 12,
                                    'lg' => 8,
                                ]),

                            // RIGHT COLUMN (Settings & Image)
                            Group::make()
                                ->schema([
                                    Section::make('Trạng thái')
                                        ->schema([
                                            Toggle::make('is_active')
                                                ->label('Kích hoạt')
                                                ->onColor('success')
                                                ->offColor('gray')
                                                ->default(false),
                                        ]),

                                    Section::make('Hình ảnh QR')
                                        ->schema([
                                            FileUpload::make('qr_image')
                                                ->label('Ảnh mã QR')
                                                ->image()
                                                ->imageEditor()
                                                ->directory('qr-codes')
                                                ->columnSpanFull(),
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
