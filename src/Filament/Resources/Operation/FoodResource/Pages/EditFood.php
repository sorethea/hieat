<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\FoodResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\FoodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFood extends EditRecord
{
    protected static string $resource = FoodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
