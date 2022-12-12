<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\CuisineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCuisine extends ViewRecord
{
    protected static string $resource = CuisineResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
