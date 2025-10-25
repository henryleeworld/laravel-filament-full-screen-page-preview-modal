<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Category;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Pboivin\FilamentPeek\Tables\Actions\ListPreviewAction;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->formatStateUsing(fn (string $state): string => __($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label(__('Published at'))
                    ->dateTime()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label(__('Is featured'))
                    ->boolean()
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                SelectFilter::make('category')
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Category $record) => __($record->name)),
                TernaryFilter::make('is_featured')
                    ->label(__('Is featured')),
            ])
            ->recordActions([
                ActionGroup::make([
                    ListPreviewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
            ]);
    }
}
