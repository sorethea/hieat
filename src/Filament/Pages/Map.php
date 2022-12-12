<?php

namespace Sorethea\Hieat\Filament\Pages;

use Filament\Pages\Page;
use function App\Filament\Pages\trans;

class Map extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static string $view = 'filament.pages.map';
    protected static function getNavigationGroup(): ?string
    {
        return trans("lang.operation");
    }
}
