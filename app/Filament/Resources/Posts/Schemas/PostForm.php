<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use App\Filament\Fields\PostContent;
use App\Filament\Fields\PostFooter;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

class PostForm
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
                            ->required()
                            ->lazy()
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                if ($get('slug')) {
                                    return;
                                }
                                $set('slug',Str::slug($state, language: app()->getLocale()));
                            }),
                        TextInput::make('slug')
                            ->label(__('Slug'))
                            ->columnSpan(1)
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->label(__('Published at'))
                            ->columnSpan(1),
                        Select::make('category_id')
                            ->label(__('Category'))
                            ->relationship('category', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Category $record): string =>  __($record->name))
                            ->columnSpan(1)
                            ->required(),
                        Toggle::make('is_featured')
                            ->label(__('Is featured'))
                            ->columnSpanFull()
                            ->required(),
                    ]),
                Section::make(__('Post content'))
                    ->schema([
                        Actions::make([
                            InlinePreviewAction::make()
                                ->label(__('Preview post content'))
                                ->builderName('content_blocks')
                        ])
                        ->columnSpanFull()
                        ->alignRight(),
                        PostContent::make('content_blocks')
                            ->label(__('Blocks'))
                            ->columnSpanFull(),
                    ])->collapsible(),
                Section::make(__('Post footer'))
                    ->schema([
                        PostFooter::make('footer_blocks')
                            ->label(__('Blocks'))
                            ->columnSpanFull(),
                    ])->collapsible(),
                TextInput::make('main_image_url')
                    ->label(__('Main image URL'))
                    ->columnSpanFull(),
                FileUpload::make('main_image_upload')
                    ->label(__('Main image upload'))
                    ->columnSpanFull(),
            ]);
    }
}
