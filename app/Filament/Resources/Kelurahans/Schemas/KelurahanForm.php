<?php

namespace App\Filament\Resources\Kelurahans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KelurahanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namaKelurahan')
                    ->required(),
            ]);
    }
}
