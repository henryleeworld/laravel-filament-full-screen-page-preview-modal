<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class Title
{
    public static function make(
        string $name = 'title',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->label(function ($state) {
                return $state['label'] ?? __('Title');
            })
            ->schema([
                TextInput::make('text')
                    ->label(__('Text'))
                    ->required(),

                Select::make('level')
                    ->label(__('Level'))
                    ->options([
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                    ])
                    ->afterStateHydrated(fn ($state, $set) => $state || $set('level', 'h2')),
            ])
            ->columns($context === 'form' ? 2 : 1);
    }
}
