<?php

namespace App\Filament\Resources\CustomTourRequestResource\Pages;

use App\Filament\Resources\CustomTourRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomTourRequest extends EditRecord
{
    protected static string $resource = CustomTourRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
