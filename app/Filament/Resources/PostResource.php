<?php

namespace App\Filament\Resources;

use App\Filament\Fields\PostContent;
use App\Filament\Fields\PostFooter;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;
use Pboivin\FilamentPeek\Tables\Actions\ListPreviewAction;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make()->columns(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->columnSpan(1)
                    ->required()
                    ->lazy()
                    ->afterStateUpdated(function ($set, $get, $state) {
                        if ($get('slug')) {
                            return;
                        }
                        $set('slug', Str::slug($state));
                    }),

                Forms\Components\TextInput::make('slug')
                    ->label(__('Slug'))
                    ->columnSpan(1)
                    ->required(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label(__('Published at'))
                    ->columnSpan(1),

                Forms\Components\Select::make('category_id')
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->columnSpan(1)
                    ->required(),

                Forms\Components\Toggle::make('is_featured')
                    ->label(__('Is featured'))
                    ->columnSpanFull()
                    ->required(),
            ]),

            Forms\Components\Section::make(__('Post Content'))->schema([
                Forms\Components\Actions::make([
                    InlinePreviewAction::make()
                        ->label(__('Preview Content Blocks'))
                        ->builderName('content_blocks')
                ])
                    ->columnSpanFull()
                    ->alignRight(),

                PostContent::make('content_blocks')
                    ->label(__('Blocks'))
                    ->columnSpanFull(),
            ])->collapsible(),

            Forms\Components\Section::make(__('Post Footer'))->schema([
                Forms\Components\Actions::make([
                    InlinePreviewAction::make()
                        ->label(__('Open Footer Editor'))
                        ->builderName('footer_blocks')
                ])
                    ->columnSpanFull()
                    ->alignRight(),

                PostFooter::make('footer_blocks')
                    ->label(__('Blocks'))
                    ->columnSpanFull(),
            ])->collapsible(),

            Forms\Components\TextInput::make('main_image_url')
                ->label(__('Main image URL'))
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('main_image_upload')
                ->label(__('Main image upload'))
                ->columnSpanFull(),
        ]);
    }

    public static function getModelLabel(): string
    {
        return __('post');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Blog');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Published at'))
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('Is featured'))
                    ->boolean()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    ListPreviewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),

                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
