<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourCategoryResource\Pages;
use App\Filament\Resources\TourCategoryResource\RelationManagers;
use App\Models\TourCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TourCategoryResource extends Resource
{
    protected static ?string $model = TourCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    
    public static function getNavigationLabel(): string { return __('Tour Categories'); }
    public static function getNavigationGroup(): ?string { return __('Content Management'); }
    public static function getModelLabel(): string { return __('Tour Category'); }
    public static function getPluralModelLabel(): string { return __('Tour Categories'); }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state)))
                    ->maxLength(255),
                Forms\Components\TextInput::make('name_ar')
                    ->label(__('Name (Arabic)'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label(__('Slug'))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description_ar')
                    ->label(__('Description (Arabic)'))
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label(__('Image'))
                    ->image(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->required(),
                Forms\Components\TextInput::make('sort_order')
                    ->label(__('Sort order'))
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListTourCategories::route('/'),
            'create' => Pages\CreateTourCategory::route('/create'),
            'edit' => Pages\EditTourCategory::route('/{record}/edit'),
        ];
    }
}
