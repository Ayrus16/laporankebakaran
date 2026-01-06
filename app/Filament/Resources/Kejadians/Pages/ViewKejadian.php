<?php

namespace App\Filament\Resources\Kejadians\Pages;

use App\Filament\Resources\Kejadians\KejadianResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKejadian extends ViewRecord
{
    protected static string $resource = KejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
