<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Informasi Berita')
                    ->description('Informasi dasar tentang berita')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => 
                                $context === 'create' ? $set('slug', Str::slug($state)) : null
                            ),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText('URL-friendly version dari judul. Akan dibuat otomatis jika kosong.'),

                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Ringkasan singkat berita (maksimal 500 karakter)'),

                        TextInput::make('author')
                            ->label('Penulis')
                            ->required()
                            ->maxLength(100)
                            ->default('Admin'),

                        TextInput::make('category')
                            ->label('Kategori')
                            ->required()
                            ->maxLength(100)
                            ->datalist([
                                'Teknologi',
                                'Bisnis',
                                'Ekonomi',
                                'Politik',
                                'Olahraga',
                                'Hiburan',
                                'Kesehatan',
                                'Pendidikan',
                                'Lingkungan',
                                'Internasional',
                            ])
                            ->helperText('Kategori berita'),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan ditampilkan lebih dulu'),
                    ])
                    ->columns(2),

                Section::make('Konten Berita')
                    ->description('Konten utama berita')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Konten')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                            ])
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('news/attachments')
                            ->helperText('Konten lengkap berita dalam format HTML'),
                    ]),

                Section::make('Media')
                    ->description('Gambar dan media pendukung')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('news-images')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Gambar utama berita (maksimal 2MB)'),
                    ]),

                Section::make('Pengaturan Publikasi')
                    ->description('Pengaturan status dan publikasi berita')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Dipublikasi',
                                'archived' => 'Diarsipkan',
                            ])
                            ->default('draft')
                            ->native(false),

                        Toggle::make('is_featured')
                            ->label('Berita Unggulan')
                            ->helperText('Tampilkan di halaman utama'),

                        Toggle::make('is_breaking')
                            ->label('Breaking News')
                            ->helperText('Tandai sebagai berita terbaru/penting'),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->helperText('Kapan berita ini akan dipublikasikan'),
                    ])
                    ->columns(2),

                Section::make('Tags & Metadata')
                    ->description('Tags dan informasi tambahan')
                    ->schema([
                        TagsInput::make('tags')
                            ->label('Tags')
                            ->suggestions([
                                'teknologi',
                                'bisnis',
                                'startup',
                                'digital',
                                'inovasi',
                                'ekonomi',
                                'politik',
                                'sosial',
                                'pendidikan',
                                'kesehatan',
                            ])
                            ->helperText('Tags untuk memudahkan pencarian dan kategorisasi'),
                    ]),
            ]);
    }
}
