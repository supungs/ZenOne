<?php

namespace App\Filament\Resources\HallBookingResource\Pages;

use App\Filament\Resources\HallBookingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHallBooking extends CreateRecord
{
    protected static string $resource = HallBookingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();    
        return $data;
    }
}
