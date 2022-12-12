<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\OrderResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\OrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
