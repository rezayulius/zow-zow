<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Services\ImageOptimizer;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Artikel')
                    ->description('Informasi dasar artikel')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $context, $state, callable $set) {
                                if ($context === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            })
                            ->columnSpanFull(),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText('URL-friendly version dari judul. Akan otomatis dibuat dari judul.')
                            ->disabled(fn (string $context): bool => $context === 'create')
                            ->dehydrated(),

                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Ringkasan singkat artikel (maksimal 500 karakter)')
                            ->columnSpanFull(),

                        TextInput::make('author')
                            ->label('Penulis')
                            ->required()
                            ->maxLength(255)
                            ->default('Tim Editorial')
                            ->datalist([
                                'Tim Editorial',
                                'Admin',
                                'Content Manager',
                            ]),
                    ])->columns(2),

                Section::make('Konten')
                    ->description('Konten utama artikel')
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
                            ->fileAttachmentsDirectory('articles/attachments'),
                    ]),

                Section::make('Media')
                    ->description('Gambar dan media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->disk('public')
                            ->directory('articles')
                            ->visibility('public')
                            ->saveUploadedFileUsing(fn ($component, $file) => ImageOptimizer::store($component, $file))
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Gambar utama artikel (opsional)'),
                    ]),

                Section::make('Pengaturan')
                    ->description('Status dan pengaturan publikasi')
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
                            ->native(false)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'published') {
                                    $set('published_at', now());
                                }
                            }),

                        Toggle::make('is_featured')
                            ->label('Artikel Unggulan')
                            ->helperText('Tampilkan sebagai artikel unggulan')
                            ->inline(false),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required(fn (callable $get): bool => $get('status') === 'published')
                            ->native(false)
                            ->visible(fn (callable $get): bool => $get('status') === 'published'),

                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan (angka lebih kecil akan tampil lebih dulu)'),

                        TextInput::make('views')
                            ->label('Jumlah Views')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->helperText('Jumlah views akan otomatis bertambah'),
                    ])->columns(2),

                Section::make('Tags & Kategori')
                    ->description('Tags untuk artikel')
                    ->schema([
                        TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Tambahkan tag...')
                            ->helperText('Tekan Enter untuk menambahkan tag baru'),
                    ]),
            ]);
    }
}
