<?php

namespace App\Filament\Resources\PickupHistoryResource\Pages;

use App\Filament\Resources\PickupHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPickupHistory extends EditRecord
{
    protected static string $resource = PickupHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
