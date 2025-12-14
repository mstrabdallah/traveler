<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\Select::make('destination_id')
                                    ->relationship('destination', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('sale_price')
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('duration_days')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Days'),
                                Forms\Components\TextInput::make('duration_nights')
                                    ->numeric()
                                    ->suffix('Nights'),
                                Forms\Components\TextInput::make('type')
                                    ->placeholder('e.g. Private Comprehensive Package'),
                                Forms\Components\TextInput::make('availability')
                                    ->placeholder('e.g. Daily'),
                            ])->columns(2),

                        Forms\Components\Section::make('Images')
                            ->schema([
                                Forms\Components\FileUpload::make('images')
                                    ->image()
                                    ->directory('tours')
                                    ->multiple()
                                    ->reorderable()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->default(true)
                                    ->required(),
                                Forms\Components\Toggle::make('is_featured')
                                    ->required(),
                            ]),
                    ])->columnSpan(['lg' => 1]),
                
                Forms\Components\Section::make('Details')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                         Forms\Components\Repeater::make('itinerary')
                            ->schema([
                                Forms\Components\TextInput::make('day_title')->required(),
                                Forms\Components\Textarea::make('description')->rows(3),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['day_title'] ?? null)
                            ->columnSpanFull(),
                         Forms\Components\Repeater::make('price_tiers')
                            ->schema([
                                Forms\Components\TextInput::make('min_people')->numeric()->required(),
                                Forms\Components\TextInput::make('max_people')->numeric()->required(),
                                Forms\Components\TextInput::make('price_per_person')->numeric()->prefix('$')->required(),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                         Forms\Components\Repeater::make('included')
                            ->simple(
                                Forms\Components\TextInput::make('item')->required(),
                            )
                            ->columnSpanFull(),
                         Forms\Components\Repeater::make('excluded')
                            ->simple(
                                Forms\Components\TextInput::make('item')->required(),
                            )
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('destination.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                 Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('destination')
                    ->relationship('destination', 'name'),
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
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
