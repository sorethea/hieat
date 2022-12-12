<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\RestaurantResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRestaurant extends EditRecord
{
    protected static string $resource = RestaurantResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
