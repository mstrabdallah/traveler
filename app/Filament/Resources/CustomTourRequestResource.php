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
    protected static ?string $navigationLabel = 'Tailor-Made Requests';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nationality')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Trip Details')
                    ->schema([
                        Forms\Components\TextInput::make('request_title')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('arrival_date'),
                        Forms\Components\DatePicker::make('departure_date'),
                        Forms\Components\TextInput::make('adults')
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('children')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('ages_range')
                            ->maxLength(255),
                    ])->columns(3),

                Forms\Components\Section::make('Preferences & Notes')
                    ->schema([
                        Forms\Components\TagsInput::make('destinations')
                            ->placeholder('Destinations')
                            ->columnSpanFull(),
                         Forms\Components\Select::make('accommodation')
                            ->options([
                                '5_star_luxury' => 'Luxury (5 Star Ultra)',
                                '5_star_standard' => 'Gold (5 Star Standard)',
                                '4_star' => 'Silver (4 Star)',
                                '3_star' => 'Bronze (3 Star)',
                            ]),
                        Forms\Components\TextInput::make('referral_source')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('notes')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_title')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('arrival_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('adults')
                    ->numeric()
                    ->label('Adults')
                    ->sortable(),
                 Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomTourRequests::route('/'),
            // 'create' => Pages\CreateCustomTourRequest::route('/create'),
            // 'edit' => Pages\EditCustomTourRequest::route('/{record}/edit'),
        ];
    }
}
