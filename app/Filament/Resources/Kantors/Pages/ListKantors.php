<?php

namespace App\Filament\Resources\Kantors\Pages;

use App\Filament\Resources\Kantors\KantorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKantors extends ListRecords
{
    protected static string $resource = KantorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
