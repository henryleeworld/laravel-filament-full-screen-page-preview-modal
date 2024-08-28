<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;

class Paragraph
{
    public static function make(
        string $name = 'paragraph',
        string $context = 'form',
    ): Block {
        return Block::make($name)
            ->label(function ($state) {
                return $state['label'] ?? __('Paragraph');
            })
            ->schema([
                RichEditor::make('text')
                    ->label(__('Content')),
            ]);
    }
}
