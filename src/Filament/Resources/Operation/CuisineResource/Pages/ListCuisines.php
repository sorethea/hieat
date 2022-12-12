<?php

namespace Sorethea\Hieat\Filament\Resources\Operation\CuisineResource\Pages;

use Sorethea\Hieat\Filament\Resources\Operation\CuisineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuisines extends ListRecords
{
    protected static string $resource = CuisineResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
