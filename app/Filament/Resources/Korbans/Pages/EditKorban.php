<?php

namespace App\Filament\Resources\Korbans\Pages;

use App\Filament\Resources\Korbans\KorbanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKorban extends EditRecord
{
    protected static string $resource = KorbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
