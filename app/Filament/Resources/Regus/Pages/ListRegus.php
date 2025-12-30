<?php

namespace App\Filament\Resources\Regus\Pages;

use App\Filament\Resources\Regus\ReguResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRegus extends ListRecords
{
    protected static string $resource = ReguResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
