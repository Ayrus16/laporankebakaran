<?php

namespace App\Filament\Resources\Regus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReguForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namaRegu')
                    ->required(),
            ]);
    }
}
