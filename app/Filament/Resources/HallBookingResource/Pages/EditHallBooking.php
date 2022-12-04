<?php

namespace App\Filament\Resources\HallBookingResource\Pages;

use App\Filament\Resources\HallBookingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditHallBooking extends EditRecord
{
    protected static string $resource = HallBookingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // Notification::make()
        //     ->warning()
        //     ->title('You don\'t have an active subscription!')
        //     ->body('Choose a plan to continue.')
        //     ->persistent()
        //     ->send();
        // $this->halt();
    }
}
