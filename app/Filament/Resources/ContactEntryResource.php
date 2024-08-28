<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactEntryResource\Pages;
use App\Models\ContactEntry;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ContactEntryResource extends Resource
{
    protected static ?string $model = ContactEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Contact';

    public static function getModelLabel(): string
    {
        return __('contact entry');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Contact');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\TextEntry::make('created_at')
                ->label(__('Date'))
                ->columnSpanFull(),

            Infolists\Components\TextEntry::make('name')
                ->label(__('Name'))
                ->columnSpanFull(),

            Infolists\Components\TextEntry::make('email')
                ->label(__('Email'))
                ->columnSpanFull(),

            Infolists\Components\TextEntry::make('message')
                ->label(__('Message'))
                ->formatStateUsing(fn ($state) => new HtmlString(nl2br($state)))
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Date'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactEntries::route('/'),
            'view' => Pages\ViewContactEntry::route('/{record}'),
            // 'create' => Pages\CreateContactEntry::route('/create'),
            // 'edit' => Pages\EditContactEntry::route('/{record}/edit'),
        ];
    }
}
