<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    
    public static function getNavigationLabel(): string { return __('Bookings'); }
    public static function getNavigationGroup(): ?string { return __('Booking Management'); }
    public static function getModelLabel(): string { return __('Booking'); }
    public static function getPluralModelLabel(): string { return __('Bookings'); }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_read', false)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Booking Information'))
                            ->schema([
                                Forms\Components\Select::make('tour_id')
                                    ->label(__('Tour'))
                                    ->relationship('tour', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\DatePicker::make('date')
                                    ->label(__('Date'))
                                    ->required(),
                                Forms\Components\TextInput::make('total_price')
                                    ->label(__('Total price'))
                                    ->required()
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\Select::make('status')
                                    ->label(__('Status'))
                                    ->options([
                                        'pending' => __('Pending'),
                                        'confirmed' => __('Confirmed'),
                                        'cancelled' => __('Cancelled'),
                                    ])
                                    ->required(),
                            ])->columns(2),
                        
                        Forms\Components\Section::make(__('Extra Details'))
                            ->schema([
                                Forms\Components\TextInput::make('meta.time')
                                    ->label(__('Preferred Time')),
                                Forms\Components\Toggle::make('meta.service_booking')
                                    ->label(__('Service per Booking (+$30)')),
                                Forms\Components\Toggle::make('meta.service_person')
                                    ->label(__('Service per Person (+$15)')),
                            ])->columns(3),
                    ])->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make(__('Customer'))
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Full Name'))
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label(__('Email address'))
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('phone')
                                    ->label(__('Phone Number'))
                                    ->tel()
                                    ->required(),
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('adults')
                                            ->label(__('Adults'))
                                            ->numeric()
                                            ->default(1),
                                        Forms\Components\TextInput::make('children')
                                            ->label(__('Children'))
                                            ->numeric()
                                            ->default(0),
                                    ]),
                            ]),
                        Forms\Components\Section::make(__('Notes'))
                            ->schema([
                                Forms\Components\Textarea::make('notes')
                                    ->label(__('Notes'))
                                    ->rows(3),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('tour.name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Customer'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->beforeFormFilled(function (Booking $record) {
                        $record->update(['is_read' => true]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
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
            'index' => Pages\ListBookings::route('/'),
        ];
    }
}
