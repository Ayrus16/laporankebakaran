<?php

namespace App\Filament\Resources\Korbans\Pages;

use App\Filament\Resources\Korbans\KorbanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKorbans extends ListRecords
{
    protected static string $resource = KorbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
