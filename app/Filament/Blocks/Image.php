<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class Image
{
    public static function make(
        string $name = 'image',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->label(function ($state) {
                return $state['label'] ?? __('Image');
            })
            ->schema([
                FileUpload::make('image')
                    ->label(__('Image upload')),

                TextInput::make('url')
                    ->label(__('or Image URL')),

                Select::make('ratio')
                    ->label(__('Ratio'))
                    ->options(static::getRatios())
                    ->afterStateHydrated(fn ($state, $set) => $state || $set('ratio', '4-3')),

                TextInput::make('alt')
                    ->label(__('Alt'))
                    ->columnSpanFull(),

                TextInput::make('caption')
                    ->label(__('Caption'))
                    ->columnSpanFull(),
            ])
            ->columns($context === 'form' ? 2 : 1);
    }

    public static function getRatios(): array
    {
        return [
            '4-3' => '4/3',
            '3-4' => '3/4',
            'free' => __('free'),
        ];
    }

    public static function getRatioClass(string $ratio): string
    {
        return match ($ratio) {
            '4-3' => 'aspect-[4/3]',
            '3-4' => 'aspect-[3/4]',
            default => '',
        };
    }
}
