<?php

namespace App\Filament\Resources\Regus\Pages;

use App\Filament\Resources\Regus\ReguResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRegu extends EditRecord
{
    protected static string $resource = ReguResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
