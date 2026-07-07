<?php

namespace App\Filament\Resources\Memberships\Schemas;

use Filament\Forms\Components\ColorPicker;
use App\Services\ImageOptimizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MembershipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Membership')
                    ->description('Informasi dasar tentang paket membership')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Membership')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Gold Member'),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->placeholder('Deskripsi lengkap tentang membership ini'),

                        Select::make('type')
                            ->label('Tipe Membership')
                            ->required()
                            ->options([
                                'basic' => 'Basic',
                                'premium' => 'Premium',
                                'vip' => 'VIP',
                                'platinum' => 'Platinum',
                                'diamond' => 'Diamond',
                            ])
                            ->placeholder('Pilih tipe membership'),

                        TextInput::make('price')
                            ->label('Harga')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('2000000'),

                        Select::make('duration')
                            ->label('Durasi')
                            ->required()
                            ->options([
                                'per bulan' => 'Per Bulan',
                                'per 3 bulan' => 'Per 3 Bulan',
                                'per 6 bulan' => 'Per 6 Bulan',
                                'per tahun' => 'Per Tahun',
                                'seumur hidup' => 'Seumur Hidup',
                            ])
                            ->placeholder('Pilih durasi membership'),
                    ])
                    ->columns(2),

                Section::make('Manfaat & Fitur')
                    ->description('Daftar manfaat yang didapat dari membership ini')
                    ->schema([
                        TagsInput::make('benefits')
                            ->label('Manfaat Membership')
                            ->placeholder('Ketik manfaat dan tekan Enter')
                            ->helperText('Contoh: Diskon 20%, Priority booking, Free consultation')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media & Tampilan')
                    ->description('Pengaturan gambar dan tampilan membership')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar Membership')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('memberships')
                            ->visibility('public')
                            ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file))
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Upload gambar untuk membership (opsional)'),

                        ColorPicker::make('badge_color')
                            ->label('Warna Badge')
                            ->default('#007bff')
                            ->helperText('Warna yang akan digunakan untuk badge membership'),
                    ])
                    ->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->description('Pengaturan status dan urutan tampil')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Membership Unggulan')
                            ->helperText('Tandai sebagai membership unggulan/rekomendasi')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->helperText('Membership aktif dan dapat dipilih oleh pengguna')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka yang lebih kecil akan tampil lebih dulu'),
                    ])
                    ->columns(3),
            ]);
    }
}
