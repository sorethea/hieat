<?php

namespace Sorethea\Hieat\Filament\Resources\Settings\ActivityResource\Pages;

use Sorethea\Hieat\Filament\Resources\Settings\ActivityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
