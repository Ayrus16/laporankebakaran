<?php

namespace App\Filament\Resources\Kantors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KantorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namaKantor')
                    ->required(),
                TextInput::make('alamat')
                    ->required(),
            ]);
    }
}
