<?php

namespace App\Filament\Blocks;

use App\Models\Page;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PageCard
{
    public static function make(
        string $name = 'page_card',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->schema([
                Select::make('page_id')
                    ->label(__('Page'))
                    ->options(Page::orderBy('title')->pluck('title', 'id')),

                TextInput::make('text')
                    ->label(__('Link text (optional)')),
            ])
            ->label(__('Link to page'))
            ->columns($context === 'form' ? 2 : 1);
    }
}
