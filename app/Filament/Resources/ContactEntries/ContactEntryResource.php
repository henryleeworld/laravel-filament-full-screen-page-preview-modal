<?php

namespace App\Filament\Resources\ContactEntries;

use App\Filament\Resources\ContactEntries\Pages\ListContactEntries;
use App\Filament\Resources\ContactEntries\Pages\ViewContactEntry;
use App\Filament\Resources\ContactEntries\Schemas\ContactEntryInfolist;
use App\Filament\Resources\ContactEntries\Tables\ContactEntriesTable;
use App\Models\ContactEntry;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ContactEntryResource extends Resource
{
    protected static ?string $model = ContactEntry::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|UnitEnum|null $navigationGroup = 'Contact';

    public static function getModelLabel(): string
    {
        return __('contact entry');
    }

    public static function getNavigationGroup(): ?string
    {
        return __(static::$navigationGroup);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ContactEntryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactEntriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactEntries::route('/'),
            'view' => ViewContactEntry::route('/{record}'),
        ];
    }
}
