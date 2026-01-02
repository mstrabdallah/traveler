<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    public static function getNavigationLabel(): string { return __('Articles'); }
    public static function getNavigationGroup(): ?string { return __('Content Management'); }
    public static function getModelLabel(): string { return __('Article'); }
    public static function getPluralModelLabel(): string { return __('Articles'); }
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label(__('Title'))
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),

                                Forms\Components\TextInput::make('title_ar')
                                    ->label(__('Title (Arabic)'))
                                    ->required(),

                                Forms\Components\TextInput::make('slug')
                                    ->label(__('Slug'))
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Article::class, 'slug', ignoreRecord: true),

                                Forms\Components\RichEditor::make('content')
                                    ->label(__('Content'))
                                    ->required()
                                    ->columnSpan('full'),

                                Forms\Components\RichEditor::make('content_ar')
                                    ->label(__('Content (Arabic)'))
                                    ->required()
                                    ->columnSpan('full'),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label(__('Excerpt'))
                                    ->rows(2)
                                    ->columnSpan('full'),
                                
                                Forms\Components\Textarea::make('excerpt_ar')
                                    ->label(__('Excerpt (Arabic)'))
                                    ->rows(2)
                                    ->columnSpan('full'),
                                
                                Forms\Components\FileUpload::make('image')
                                    ->label(__('Image'))
                                    ->image()
                                    ->disk('public')
                                    ->directory('articles')
                                    ->imageEditor()
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Status'))
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label(__('Show on Website'))
                                    ->helperText(__('This article will be hidden from all channels.'))
                                    ->default(true),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label(__('Published At'))
                                    ->default(now()),
                            ]),

                        Forms\Components\Section::make(__('SEO'))
                            ->schema([
                                Forms\Components\TextInput::make('seo_title')
                                    ->label(__('SEO Title')),
                                Forms\Components\Textarea::make('seo_description')
                                    ->label(__('SEO Description')),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('Image')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('Published At'))
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_visible')
                    ->label(__('Active'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
