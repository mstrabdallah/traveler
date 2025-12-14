<?php

namespace App\Filament\Resources\CustomTourRequestResource\Pages;

use App\Filament\Resources\CustomTourRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomTourRequests extends ListRecords
{
    protected static string $resource = CustomTourRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
