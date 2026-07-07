<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use App\Services\ImageOptimizer;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Testimonial')
                    ->description('Data utama testimonial pelanggan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nama lengkap pelanggan yang memberikan testimonial'),

                        TextInput::make('position')
                            ->label('Jabatan')
                            ->maxLength(255)
                            ->helperText('Jabatan atau profesi pelanggan'),

                        TextInput::make('company')
                            ->label('Perusahaan')
                            ->maxLength(255)
                            ->helperText('Nama perusahaan tempat bekerja'),

                        Textarea::make('content')
                            ->label('Isi Testimonial')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull()
                            ->helperText('Isi testimonial dari pelanggan'),

                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('testimonials/avatars')
                            ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file))
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->helperText('Upload foto profil pelanggan (opsional)'),

                        Select::make('rating')
                            ->label('Rating')
                            ->required()
                            ->options([
                                1 => '1 Bintang (★☆☆☆☆)',
                                2 => '2 Bintang (★★☆☆☆)',
                                3 => '3 Bintang (★★★☆☆)',
                                4 => '4 Bintang (★★★★☆)',
                                5 => '5 Bintang (★★★★★)',
                            ])
                            ->default(5)
                            ->helperText('Rating kepuasan pelanggan'),
                    ])->columns(2),

                Section::make('Informasi Hewan Peliharaan')
                    ->description('Data hewan peliharaan yang dirawat')
                    ->schema([
                        TextInput::make('pet_name')
                            ->label('Nama Hewan')
                            ->maxLength(255)
                            ->helperText('Nama hewan peliharaan yang dirawat'),

                        Select::make('pet_type')
                            ->label('Jenis Hewan')
                            ->options([
                                'anjing' => 'Anjing',
                                'kucing' => 'Kucing',
                                'burung' => 'Burung',
                                'hamster' => 'Hamster',
                                'kelinci' => 'Kelinci',
                                'ikan' => 'Ikan',
                                'reptil' => 'Reptil',
                                'lainnya' => 'Lainnya',
                            ])
                            ->helperText('Jenis hewan peliharaan'),
                    ])->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->description('Pengaturan untuk menampilkan testimonial')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Testimonial Unggulan')
                            ->helperText('Tampilkan sebagai testimonial unggulan di halaman utama'),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Aktifkan untuk menampilkan testimonial di website'),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampil testimonial (angka kecil tampil lebih dulu)'),
                    ])->columns(3),
            ]);
    }
}
