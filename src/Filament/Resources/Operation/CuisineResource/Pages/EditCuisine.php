<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\CuisineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuisine extends EditRecord
{
    protected static string $resource = CuisineResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
