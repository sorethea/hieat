<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\FoodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFood extends ViewRecord
{
    protected static string $resource = FoodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
