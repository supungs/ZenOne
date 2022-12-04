<?php

namespace App\Filament\Resources\HallBookingResource\Pages;

use App\Filament\Resources\HallBookingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHallBookings extends ListRecords
{
    protected static string $resource = HallBookingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
