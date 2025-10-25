<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('items')
                    ->label(__('Items'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label(__('Title'))
                                    ->columnSpan(1)
                                    ->required(),
                                TextInput::make('url')
                                    ->label(__('Url'))
                                    ->columnSpan(1)
                                    ->required(),
                            ]),
                        Radio::make('type')
                            ->label(__('Type'))
                            ->options([
                                'internal' => __('internal'),
                                'external' => __('external'),
                            ])
                            ->default('internal')
                            ->required()
                            ->inline(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
