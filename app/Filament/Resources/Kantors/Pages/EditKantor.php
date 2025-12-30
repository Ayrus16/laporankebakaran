<?php

namespace App\Filament\Resources\Kantors\Pages;

use App\Filament\Resources\Kantors\KantorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKantor extends EditRecord
{
    protected static string $resource = KantorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
