<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Home extends BaseDashboard
{
    protected static ?string $title = 'Home';
    protected static ?string $navigationLabel = 'Home';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?int $navigationSort = -100; // biar di atas

    protected function getHeaderWidgets(): array
    {
        return [
            // HomeStats::class,
        ];
    }
}
