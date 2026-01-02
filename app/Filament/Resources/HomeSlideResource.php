<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSlideResource\Pages;
use App\Filament\Resources\HomeSlideResource\RelationManagers;
use App\Models\HomeSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeSlideResource extends Resource
{
    protected static ?string $model = HomeSlide::class;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    public static function getNavigationLabel(): string { return __('Home Head'); }
    public static function getNavigationGroup(): ?string { return __('Settings Management'); }
    public static function getModelLabel(): string { return __('Home Head'); }
    public static function getPluralModelLabel(): string { return __('Home Head'); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Common Information'))
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label(__('Image'))
                            ->image()
                            ->directory('home-slides')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('button_url')
                            ->label(__('Button URL'))
                            ->url()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->required()
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('Sort order'))
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\Section::make(__('English Content'))
                            ->schema([
                                Forms\Components\TextInput::make('subtitle_en')
                                    ->label(__('Subtitle'))
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('title_en')
                                    ->label(__('Title'))
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description_en')
                                    ->label(__('Description'))
                                    ->rows(3),
                                Forms\Components\TextInput::make('button_text_en')
                                    ->label(__('Button Text'))
                                    ->maxLength(255),
                            ])->columnSpan(1),

                        Forms\Components\Section::make(__('Arabic Content'))
                            ->schema([
                                Forms\Components\TextInput::make('subtitle_ar')
                                    ->label(__('Subtitle (Arabic)'))
                                    ->extraInputAttributes(['dir' => 'rtl'])
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('title_ar')
                                    ->label(__('Title (Arabic)'))
                                    ->extraInputAttributes(['dir' => 'rtl'])
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('description_ar')
                                    ->label(__('Description (Arabic)'))
                                    ->extraInputAttributes(['dir' => 'rtl'])
                                    ->rows(3),
                                Forms\Components\TextInput::make('button_text_ar')
                                    ->label(__('Button Text (Arabic)'))
                                    ->extraInputAttributes(['dir' => 'rtl'])
                                    ->maxLength(255),
                            ])->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('Image'))
                    ->circular(),
                Tables\Columns\TextColumn::make('title_en')
                    ->label(__('Title (EN)'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title_ar')
                    ->label(__('Title (AR)'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('Sort order'))
                    ->numeric()
                    ->sortable(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
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
            'index' => Pages\ListHomeSlides::route('/'),
            'create' => Pages\CreateHomeSlide::route('/create'),
            'edit' => Pages\EditHomeSlide::route('/{record}/edit'),
        ];
    }
}
