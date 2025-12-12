<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FaqForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi FAQ')
                    ->description('Kelola pertanyaan dan jawaban yang sering diajukan.')
                    ->icon('heroicon-o-question-mark-circle')
                    ->schema([
                        TextInput::make('question')
                            ->label('Pertanyaan')
                            ->placeholder('Contoh: Bagaimana cara membuat janji temu?')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text'),

                        RichEditor::make('answer')
                            ->label('Jawaban')
                            ->placeholder('Tulis jawaban lengkap di sini...')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'bulletList',
                                'orderedList',
                                'redo',
                                'undo',
                            ]),

                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true)
                            ->onIcon('heroicon-o-check')
                            ->offIcon('heroicon-o-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),

                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->prefixIcon('heroicon-o-bars-arrow-up')
                            ->helperText('Angka lebih kecil akan tampil lebih dulu'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
