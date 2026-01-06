<?php

namespace App\Filament\Resources\Kejadians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KejadianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('idKelurahan')
                    ->required()
                    ->numeric(),
                TextInput::make('idKecamatan')
                    ->required()
                    ->numeric(),
                TextInput::make('idLaporan')
                    ->numeric(),
                TextInput::make('idKorban')
                    ->numeric(),
                TextInput::make('idRegu')
                    ->numeric(),
                TextInput::make('LokasiKejadian')
                    ->required(),
                TextInput::make('luasTerbakar')
                    ->numeric(),
                DatePicker::make('tanggalKejadian'),
                DateTimePicker::make('waktuPenanganan'),
                DateTimePicker::make('waktuSelesai'),
                TextInput::make('tafsiranKerugian')
                    ->numeric(),
                TextInput::make('fotoKejadian'),
                Textarea::make('keteranganTambahan')
                    ->columnSpanFull(),
                Textarea::make('penyebabKebakaran')
                    ->columnSpanFull(),
            ]);
    }
}
