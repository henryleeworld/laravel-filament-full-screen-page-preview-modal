<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Filament\Fields\PageContent;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Grid::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label(__('Title'))
                            ->columnSpan(1)
                            ->lazy()
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                if ($get('slug')) {
                                    return;
                                }
                                $set('slug', Str::slug($state, language: app()->getLocale()));
                            })
                            ->required(),
                        TextInput::make('slug')
                            ->label(__('Slug'))
                            ->columnSpan(1)
                            ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state, language: app()->getLocale())))
                            ->required(),
                    ]),
                PageContent::make('content')
                    ->label(__('Content'))
                    ->required(),
            ]);
    }
}
