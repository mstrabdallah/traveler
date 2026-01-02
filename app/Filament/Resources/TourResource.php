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

    public static function getNavigationLabel(): string { return __('Tours'); }
    public static function getNavigationGroup(): ?string { return __('Content Management'); }
    public static function getModelLabel(): string { return __('Tour'); }
    public static function getPluralModelLabel(): string { return __('Tours'); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        // Section 1: Basic Information
                        Forms\Components\Section::make(__('Basic Information'))
                            ->description(__('Identify the tour and set its base price.'))
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Name'))
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('name_ar')
                                    ->label(__('Name (Arabic)'))
                                    ->required()
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('slug')
                                    ->label(__('Slug'))
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(2),
                                Forms\Components\Select::make('destination_id')
                                    ->label(__('Destination'))
                                    ->relationship('destination', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\Select::make('categories')
                                    ->label(__('Categories'))
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\TextInput::make('price')
                                    ->label(__('Price'))
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('sale_price')
                                    ->label(__('Sale price'))
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\RichEditor::make('description')
                                    ->label(__('Description'))
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description_ar')
                                    ->label(__('Description (Arabic)'))
                                    ->columnSpanFull(),
                            ])->columns(2),

                        // Section 2: Logistics & Duration
                        Forms\Components\Section::make(__('Logistics & Availability'))
                            ->description(__('Set timing and location details.'))
                            ->schema([
                                Forms\Components\TextInput::make('duration_days')
                                    ->label(__('Duration (Days)'))
                                    ->required()
                                    ->numeric()
                                    ->suffix(__('Days')),
                                Forms\Components\TextInput::make('duration_nights')
                                    ->label(__('Duration (Nights)'))
                                    ->numeric()
                                    ->suffix(__('Nights')),
                                Forms\Components\TextInput::make('availability')
                                    ->label(__('Tour Availability'))
                                    ->placeholder(__('e.g. Daily, Every Monday')),
                                Forms\Components\TextInput::make('availability_ar')
                                    ->label(__('Availability (Arabic)'))
                                    ->placeholder(__('e.g. Daily, Every Monday')),
                                Forms\Components\TextInput::make('pickup_location')
                                    ->label(__('Pickup Location'))
                                    ->placeholder(__('e.g. Cairo Airport, Hotel Pickup')),
                                Forms\Components\TextInput::make('pickup_location_ar')
                                    ->label(__('Pickup Location (Arabic)'))
                                    ->placeholder(__('e.g. Cairo Airport, Hotel Pickup')),
                            ])->columns(2),

                        // Section 3: Media
                        Forms\Components\Section::make(__('Gallery'))
                            ->description(__('Upload high-quality images for the tour.'))
                            ->headerActions([
                                Forms\Components\Actions\Action::make('import_url')
                                    ->label(__('Fetch from URL'))
                                    ->icon('heroicon-o-link')
                                    ->form([
                                        Forms\Components\TextInput::make('url')
                                            ->label(__('Image URL'))
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
                                            \Filament\Notifications\Notification::make()->title(__('Image fetched!'))->success()->send();
                                        } catch (\Exception $e) {
                                            \Filament\Notifications\Notification::make()->title(__('Error'))->body($e->getMessage())->danger()->send();
                                        }
                                    }),
                            ])
                            ->schema([
                                Forms\Components\FileUpload::make('images')
                                    ->label(__('Gallery (Images & Videos)'))
                                    ->acceptedFileTypes(['image/*', 'video/*'])
                                    ->disk('public')
                                    ->directory('tours')
                                    ->multiple()
                                    ->reorderable()
                                    ->appendFiles()
                                    ->imagePreviewHeight('150')
                                    ->panelLayout('grid')
                                    ->columnSpanFull()
                                    ->required(),

                                Forms\Components\Placeholder::make('gallery_note')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString('
                                        <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg text-sm text-blue-700 dark:text-blue-300">
                                            <strong>' . __('Note:') . '</strong> ' . __('The first image in the order will be the tour\'s main image.') . '
                                        </div>
                                    ')),
                            ]),

                        // Section 4: Content
                        Forms\Components\Section::make(__('Included / Excluded'))
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Repeater::make('included')
                                            ->label(__('Included Items'))
                                            ->schema([
                                                Forms\Components\TextInput::make('item')->label(__('Item'))->required(),
                                                Forms\Components\TextInput::make('item_ar')->label(__('Item (Arabic)')),
                                            ])
                                            ->columns(2)
                                            ->collapsible(),
                                        Forms\Components\Repeater::make('excluded')
                                            ->label(__('Excluded Items'))
                                            ->schema([
                                                Forms\Components\TextInput::make('item')->label(__('Item'))->required(),
                                                Forms\Components\TextInput::make('item_ar')->label(__('Item (Arabic)')),
                                            ])
                                            ->columns(2)
                                            ->collapsible(),
                                    ]),
                            ]),

                        // Section 5: Map
                        Forms\Components\Section::make(__('Location Map'))
                            ->description(__('Embed a Google Map for this tour.'))
                            ->schema([
                                Forms\Components\TextInput::make('map_url')
                                    ->label(__('Google Maps Embed URL / Iframe Tag'))
                                    ->placeholder(__('Paste iframe tag or URL here'))
                                    ->helperText(__('Paste the full <iframe> from Google Maps and we will clean it for you.'))
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
                        Forms\Components\Section::make(__('Daily Itinerary'))
                            ->schema([
                                Forms\Components\Repeater::make('itinerary')
                                    ->label(__('Daily Itinerary'))
                                    ->schema([
                                        Forms\Components\TextInput::make('day_title')
                                            ->label(__('Day Title'))
                                            ->placeholder(__('e.g. Day 1: Arrival and Cairo Tour'))
                                            ->required(),
                                        Forms\Components\TextInput::make('day_title_ar')
                                            ->label(__('Day Title (Arabic)'))
                                            ->placeholder(__('e.g. Day 1: Arrival and Cairo Tour'))
                                            ->required(),
                                        Forms\Components\RichEditor::make('description')
                                            ->label(__('Description')),
                                        Forms\Components\RichEditor::make('description_ar')
                                            ->label(__('Description (Arabic)')),
                                    ])
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(fn (array $state): ?string => $state['day_title_ar'] ?? $state['day_title'] ?? null)
                                    ->columnSpanFull(),
                            ]),

                        // Section 7: Pricing & Discounts (Moved to Main Column)
                        Forms\Components\Section::make(__('Pricing & Seasonal Discounts'))
                            ->description(__('Configure group discounts and seasonal price variations.'))
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('has_price_tiers')
                                            ->label(__('Group Discounts'))
                                            ->helperText(__('Price varies by number of guests.'))
                                            ->live()
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                if ($state) $set('has_seasonal_prices', false);
                                            }),
                                        Forms\Components\Toggle::make('has_seasonal_prices')
                                            ->label(__('Seasonal Pricing'))
                                            ->helperText(__('Price varies by date ranges.'))
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
                                            ->label(__('Base Adult Price')),
                                        Forms\Components\TextInput::make('child_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label(__('Base Child Price')),
                                        Forms\Components\TextInput::make('solo_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label(__('Solo Adult Price')),
                                        Forms\Components\TextInput::make('child_solo_price')
                                            ->numeric()
                                            ->prefix('$')
                                            ->label(__('Solo Child Price')),
                                    ]),

                                Forms\Components\Repeater::make('price_tiers')
                                    ->label(__('Standard Group Tiers (2+ Guests)'))
                                    ->schema([
                                        Forms\Components\TextInput::make('min_people')->numeric()->required()->label(__('Min')),
                                        Forms\Components\TextInput::make('max_people')->numeric()->required()->label(__('Max')),
                                        Forms\Components\TextInput::make('price_per_person')->numeric()->prefix('$')->required()->label(__('Adult Price')),
                                        Forms\Components\TextInput::make('child_price_per_person')->numeric()->prefix('$')->label(__('Child Price')),
                                    ])
                                    ->columns(4)
                                    ->hidden(fn (Forms\Get $get) => !$get('has_price_tiers'))
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('divider')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString('<hr class="my-4 opacity-50">'))
                                    ->hidden(fn (Forms\Get $get) => !$get('has_seasonal_prices')),

                                Forms\Components\Repeater::make('seasonal_prices')
                                    ->label(__('Seasonal Price Variations'))
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('name')->label(__('Name'))->required()->placeholder(__('e.g. Christmas Season')),
                                                Forms\Components\DatePicker::make('start_date')->label(__('Start date'))->required(),
                                                Forms\Components\DatePicker::make('end_date')->label(__('End date'))->required(),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('solo_price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->label(__('Season Solo Adult Price')),
                                                Forms\Components\TextInput::make('child_solo_price')
                                                    ->numeric()
                                                    ->prefix('$')
                                                    ->label(__('Season Solo Child Price')),
                                            ]),
                                        
                                        Forms\Components\Repeater::make('tiers')
                                            ->label(__('Season Price Tiers'))
                                            ->schema([
                                                Forms\Components\TextInput::make('min_people')->numeric()->required()->label(__('Min')),
                                                Forms\Components\TextInput::make('max_people')->numeric()->required()->label(__('Max')),
                                                Forms\Components\TextInput::make('price_per_person')->numeric()->prefix('$')->required()->label(__('Adult')),
                                                Forms\Components\TextInput::make('child_price_per_person')->numeric()->prefix('$')->label(__('Child')),
                                            ])
                                            ->columns(4)
                                            ->columnSpanFull(),
                                    ])
                                    ->hidden(fn (Forms\Get $get) => !$get('has_seasonal_prices'))
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? __('New Season'))
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('extras_divider')
                                    ->label('')
                                    ->content(new \Illuminate\Support\HtmlString('<hr class="my-4 opacity-50">')),

                                Forms\Components\Repeater::make('extras')
                                    ->label(__('Tour Extras & Add-ons'))
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('Name'))
                                            ->required()
                                            ->placeholder(__('e.g. Airport Transfer')),
                                        Forms\Components\TextInput::make('name_ar')
                                            ->label(__('Name (Arabic)'))
                                            ->placeholder(__('مثلاً: توصيل للمطار')),
                                        Forms\Components\TextInput::make('price')
                                            ->label(__('Price'))
                                            ->numeric()
                                            ->prefix('$')
                                            ->required(),
                                        Forms\Components\Select::make('type')
                                            ->label(__('Type'))
                                            ->options([
                                                'per_booking' => __('Per Booking'),
                                                'per_person' => __('Per Person'),
                                            ])
                                            ->required()
                                            ->default('per_person'),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => $state['name_ar'] ?? $state['name'] ?? __('New Extra')),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Visibility Status'))
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label(__('Show on Website'))
                                    ->default(true),
                                Forms\Components\Toggle::make('is_featured')
                                    ->label(__('Featured Tour')),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('destination.name')
                    ->label(__('Destination'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Active'))
                    ->boolean(),
                 Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('Featured Tour'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('destination')
                    ->label(__('Destination'))
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
