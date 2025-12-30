<?php

namespace App\Filament\Resources\Korbans\Pages;

use App\Filament\Resources\Korbans\KorbanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKorban extends ViewRecord
{
    protected static string $resource = KorbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
