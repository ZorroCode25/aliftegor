<?php

namespace App\Filament\Resources\PickupHistoryResource\Pages;

use App\Filament\Resources\PickupHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPickupHistories extends ListRecords
{
    protected static string $resource = PickupHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
