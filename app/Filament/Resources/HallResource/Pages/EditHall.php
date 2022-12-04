<?php

namespace App\Filament\Resources\HallResource\Pages;

use App\Filament\Resources\HallResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHall extends EditRecord
{
    protected static string $resource = HallResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
