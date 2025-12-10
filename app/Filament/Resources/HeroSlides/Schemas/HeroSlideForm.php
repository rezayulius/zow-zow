<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('highlight_text')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('badge_text')
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Call to Action')
                    ->schema([
                        TextInput::make('primary_cta_text')
                            ->label('Primary Button Text')
                            ->default('Start Your Journey'),
                        TextInput::make('primary_cta_url')
                            ->label('Primary Button URL')
                            ->default('#booking'),
                        TextInput::make('secondary_cta_text')
                            ->label('Secondary Button Text')
                            ->default('Chat with Us'),
                        TextInput::make('secondary_cta_url')
                            ->label('Secondary Button URL')
                            ->default('https://wa.me/6281219088899'),
                    ])->columns(2),

                Section::make('Visuals & Settings')
                    ->schema([
                        FileUpload::make('main_image')
                            ->image()
                            ->disk('public')
                            ->directory('hero-slides')
                            ->visibility('public')
                            ->required(),
                        FileUpload::make('secondary_image')
                            ->image()
                            ->disk('public')
                            ->directory('hero-slides')
                            ->visibility('public'),
                        Select::make('theme_color')
                            ->options([
                                'forest-moss-green' => 'Forest Moss Green',
                                'chai' => 'Chai',
                                'soft-blush-pink' => 'Soft Blush Pink',
                                'deep-cocoa-brown' => 'Deep Cocoa Brown',
                            ])
                            ->required()
                            ->default('forest-moss-green'),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
