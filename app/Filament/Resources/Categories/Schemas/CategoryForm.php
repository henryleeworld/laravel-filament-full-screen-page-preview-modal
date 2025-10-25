<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->lazy()
                    ->maxLength(255)
                    ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state, language: app()->getLocale())))
                    ->required(),
                TextInput::make('slug')
                    ->label(__('Slug'))
                    ->lazy()
                    ->afterStateUpdated(fn ($state, Set $set) => $set('slug', Str::slug($state, language: app()->getLocale())))
                    ->required(),
            ]);
    }
}
