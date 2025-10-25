<?php

namespace App\Filament\Resources\ContactEntries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ContactEntryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->label(__('Date'))
                    ->columnSpanFull(),
                TextEntry::make('name')
                    ->label(__('Name'))
                    ->columnSpanFull(),
                TextEntry::make('email')
                    ->label(__('Email'))
                    ->columnSpanFull(),
                TextEntry::make('message')
                    ->label(__('Message'))
                    ->formatStateUsing(fn($state) => new HtmlString(nl2br($state)))
                    ->columnSpanFull(),
            ]);
    }
}
