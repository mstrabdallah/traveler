<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomTourRequestResource\Pages;
use App\Filament\Resources\CustomTourRequestResource\RelationManagers;
use App\Models\CustomTourRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomTourRequestResource extends Resource
{
    protected static ?string $model = CustomTourRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    
    public static function getNavigationLabel(): string { return __('Custom Tour Requests'); }
    public static function getNavigationGroup(): ?string { return __('Booking Management'); }
    public static function getModelLabel(): string { return __('Custom Tour Request'); }
    public static function getPluralModelLabel(): string { return __('Custom Tour Requests'); }
    
    protected static ?int $navigationSort = 2;

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
                Forms\Components\Section::make(__('Personal Information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Full Name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email address'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('Phone Number'))
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nationality')
                            ->label(__('Nationality'))
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make(__('Trip Details'))
                    ->schema([
                        Forms\Components\TextInput::make('request_title')
                            ->label(__('Request title'))
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('arrival_date')
                            ->label(__('Arrival Date')),
                        Forms\Components\DatePicker::make('departure_date')
                            ->label(__('Departure Date')),
                        Forms\Components\TextInput::make('adults')
                            ->label(__('Adults'))
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('children')
                            ->label(__('Children'))
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('ages_range')
                            ->label(__('Children Ages'))
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make(__('Preferences & Notes'))
                    ->schema([
                        Forms\Components\TagsInput::make('destinations')
                            ->label(__('Destinations'))
                            ->placeholder(__('Destinations'))
                            ->columnSpanFull(),
                         Forms\Components\Select::make('accommodation')
                            ->label(__('Accommodation Preference'))
                            ->options([
                                '5_star_luxury' => __('Luxury (5 Star Ultra)'),
                                '5_star_standard' => __('Gold (5 Star Standard)'),
                                '4_star' => __('Silver (4 Star)'),
                                '3_star' => __('Bronze (3 Star)'),
                            ]),
                        Forms\Components\TextInput::make('referral_source')
                            ->label(__('How did you hear about us?'))
                            ->maxLength(255),
                        Forms\Components\Textarea::make('notes')
                            ->label(__('Notes'))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_title')
                    ->label(__('Request title'))
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email address'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone Number'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('arrival_date')
                    ->label(__('Arrival Date'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adults')
                    ->numeric()
                    ->label(__('Adults'))
                    ->sortable(),
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
                Tables\Actions\ViewAction::make()
                    ->beforeFormFilled(function (CustomTourRequest $record) {
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
            'index' => Pages\ListCustomTourRequests::route('/'),
        ];
    }
}
