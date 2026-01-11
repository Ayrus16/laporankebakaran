<?php

namespace App\Filament\Widgets;

use App\Models\Kejadian;
use App\Models\Laporan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class HomeStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Laporan Baru', Laporan::query()->where('status', 'diterima')->count()),

            Stat::make('Jumlah Kejadian', Kejadian::query()->count())
                ->description('Total kejadian'),
        ];
    }
}
