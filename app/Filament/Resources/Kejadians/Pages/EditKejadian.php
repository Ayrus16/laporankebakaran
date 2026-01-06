<?php

namespace App\Filament\Resources\Kejadians\Pages;

use App\Filament\Resources\Kejadians\KejadianResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKejadian extends EditRecord
{
    protected static string $resource = KejadianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
