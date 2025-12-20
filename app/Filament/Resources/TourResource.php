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
                        // Section 1: Basic Information
                        Forms\Components\Section::make('Basic Information')
                            ->description('Identify the tour and set its base price.')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(2),
                                Forms\Components\Select::make('destination_id')
                                    ->relationship('destination', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('sale_price')
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        // Section 2: Logistics & Duration
                        Forms\Components\Section::make('Logistics & Availability')
                            ->description('Set timing and location details.')
                            ->schema([
                                Forms\Components\TextInput::make('duration_days')
                                    ->required()
                                    ->numeric()
                                    ->suffix('Days'),
                                Forms\Components\TextInput::make('duration_nights')
                                    ->numeric()
                                    ->suffix('Nights'),
                                Forms\Components\TextInput::make('availability')
                                    ->placeholder('e.g. Daily, Every Monday')
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('pickup_location')
                                    ->placeholder('e.g. Cairo Airport, Hotel Pickup')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        // Section 3: Media
                        Forms\Components\Section::make('Gallery')
                            ->description('Upload high-quality images for the tour.')
                            ->headerActions([
                                Forms\Components\Actions\Action::make('import_url')
                                    ->label('Fetch from URL')
                                    ->icon('heroicon-o-link')
                                    ->form([
                                        Forms\Components\TextInput::make('url')
                                            ->label('Image URL')
                                            ->required()
                                            ->url(),
                                    ])
                                    ->action(function (array $data, Forms\Get $get, Forms\Set $set) {
                                        try {
                                            $url = $data['url'];
                                            $contents = file_get_contents($url);
                                            if ($contents === false) throw new \Exception('Failed to download image.');
                                            $name = Str::random(40) . '.jpg';
                                            $path = 'tours/' . $name;
                                            \Illuminate\Support\Facades\Storage::disk('public')->put($path, $contents);
                                            $state = $get('images') ?? [];
                                            $state[] = $path;
                                            $set('images', $state);
                                            \Filament\Notifications\Notification::make()->title('Image fetched!')->success()->send();
                                        } catch (\Exception $e) {
                                            \Filament\Notifications\Notification::make()->title('Error')->body($e->getMessage())->danger()->send();
                                        }
                                    }),
                            ])
                            ->schema([
                                Forms\Components\FileUpload::make('images')
                                    ->image()
                                    ->directory('tours')
                                    ->multiple()
                                    ->reorderable()
                                    ->columnSpanFull(),
                            ]),

                        // Section 4: Content
                        Forms\Components\Section::make('Included / Excluded')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Repeater::make('included')
                                            ->label('Included Items')
                                            ->simple(Forms\Components\TextInput::make('item')->required())
                                            ->collapsible(),
                                        Forms\Components\Repeater::make('excluded')
                                            ->label('Excluded Items')
                                            ->simple(Forms\Components\TextInput::make('item')->required())
                                            ->collapsible(),
                                    ]),
                            ]),

                        // Section 5: Map
                        Forms\Components\Section::make('Location Map')
                            ->description('Embed a Google Map for this tour.')
                            ->schema([
                                Forms\Components\TextInput::make('map_url')
                                    ->label('Google Maps Embed URL / Iframe Tag')
                                    ->placeholder('Paste iframe tag or URL here')
                                    ->helperText('Paste the full <iframe> from Google Maps and we will clean it for you.')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        if (!$state) return;
                                        if (preg_match('/src="([^"]+)"/', $state, $matches)) {
                                            $set('map_url', $matches[1]);
                                            return;
                                        }
                                        if (str_contains($state, 'google.com/maps/dir/')) {
                                            $path = parse_url($state, PHP_URL_PATH);
                                            $parts = explode('/', trim($path, '/'));
                                            $dirIndex = array_search('dir', $parts);
                                            if ($dirIndex !== false) {
                                                $locations = array_slice($parts, $dirIndex + 1);
                                                $locations = array_filter($locations, fn($loc) => !str_starts_with($loc, '@'));
                                                if (count($locations) >= 2) {
                                                    $origin = $locations[array_key_first($locations)];
                                                    $dest = end($locations);
                                                    $embedUrl = "https://maps.google.com/maps?saddr=" . urlencode(str_replace('+', ' ', $origin)) . "&daddr=" . urlencode(str_replace('+', ' ', $dest)) . "&output=embed";
                                                    $set('map_url', $embedUrl);
                                                }
                                            }
                                        }
                                    }),
                            ]),

                        // Section 6: Itinerary
                        Forms\Components\Section::make('Daily Itinerary')
                            ->schema([
                                Forms\Components\Repeater::make('itinerary')
                                    ->schema([
                                        Forms\Components\TextInput::make('day_title')
                                            ->placeholder('e.g. Day 1: Arrival and Cairo Tour')
                                            ->required(),
                                        Forms\Components\RichEditor::make('description'),
                                    ])
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(fn (array $state): ?string => $state['day_title'] ?? null)
                                    ->columnSpanFull(),
                            ]),

                        // Section 7: Pricing & Discounts (Moved to Main Column)
                        Forms\Components\Section::make('Pricing & Seasonal Discounts')
                            ->description('Configure group discounts and seasonal price variations.')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('has_price_tiers')
                                            ->label('Group Discounts')
                                            ->helperText('Price varies by number of guests.')
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if ($state) $set('has_seasonal_prices', false);
                                            }),
                                        Forms\Components\Toggle::make('has_seasonal_prices')
                                            ->label('Seasonal Pricing')
                                            ->helperText('Price varies by date ranges.')
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if ($state) $set('has_price_tiers', false);
                                            }),
                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->required()
                                            ->label('Base Adult Price'),
                                        Forms\Components\TextInput::make('child_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('Base Child Price'),
                                        Forms\Components\TextInput::make('solo_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('Solo Adult Price'),
                                        Forms\Components\TextInput::make('child_solo_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label('Solo Child Price'),
                                    ]),

                                Forms\Components\Repeater::make('price_tiers')
                                    ->label('Standard Group Tiers (2+ Guests)')
                                    ->schema([
                                        Forms\Components\TextInput::make('min_people')->numeric()->required()->label('Min'),
                                        Forms\Components\TextInput::make('max_people')->numeric()->required()->label('Max'),
                                        Forms\Components\TextInput::make('price_per_person')->numeric()->prefix('$')->required()->label('Adult Price'),
                                        Forms\Components\TextInput::make('child_price_per_person')->numeric()->prefix('$')->label('Child Price'),
                                    ])
                                    ->columns(4)
                                    ->hidden(fn (Forms\Get $get) => !$get('has_price_tiers'))
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('divider')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString('<hr class="my-4 opacity-50">'))
                                    ->hidden(fn (Forms\Get $get) => !$get('has_seasonal_prices')),

                                Forms\Components\Repeater::make('seasonal_prices')
                                    ->label('Seasonal Price Variations')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('name')->required()->placeholder('e.g. Christmas Season'),
                                                Forms\Components\DatePicker::make('start_date')->required(),
                                                Forms\Components\DatePicker::make('end_date')->required(),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('solo_price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->label('Season Solo Adult Price'),
                                                Forms\Components\TextInput::make('child_solo_price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->label('Season Solo Child Price'),
                                            ]),
                                        
                                        Forms\Components\Repeater::make('tiers')
                                            ->label('Season Price Tiers')
                                            ->schema([
                                                Forms\Components\TextInput::make('min_people')->numeric()->required()->label('Min'),
                                                Forms\Components\TextInput::make('max_people')->numeric()->required()->label('Max'),
                                                Forms\Components\TextInput::make('price_per_person')->numeric()->prefix('$')->required()->label('Adult'),
                                                Forms\Components\TextInput::make('child_price_per_person')->numeric()->prefix('$')->label('Child'),
                                            ])
                                            ->columns(4)
                                            ->columnSpanFull(),
                                    ])
                                    ->hidden(fn (Forms\Get $get) => !$get('has_seasonal_prices'))
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Season')
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('extras_divider')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString('<hr class="my-4 opacity-50">')),

                                Forms\Components\Repeater::make('extras')
                                    ->label('Tour Extras & Add-ons')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->placeholder('e.g. Airport Transfer'),
                                        Forms\Components\TextInput::make('price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->required(),
                                        Forms\Components\Select::make('type')
                                            ->options([
                                                'per_booking' => 'Per Booking',
                                                'per_person' => 'Per Person',
                                            ])
                                            ->required()
                                            ->default('per_person'),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'New Extra'),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Visibility Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Show on Website')
                                    ->default(true),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Featured Tour'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
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
