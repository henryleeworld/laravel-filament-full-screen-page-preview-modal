<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationLabel = 'Navigation';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Repeater::make('items')
                ->label(__('Items'))
                ->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('Title'))
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('url')
                            ->label(__('Url'))
                            ->required()
                            ->columnSpan(1),
                    ]),

                    Forms\Components\Radio::make('type')
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

    public static function getModelLabel(): string
    {
        return __('menu');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Site');
    }

    public static function getNavigationLabel(): string
    {
        return __('Navigation');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->filters([])
            ->bulkActions([]);
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
            'index' => Pages\ListMenus::route('/'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
            // 'create' => Pages\CreateMenu::route('/create'),
        ];
    }
}
