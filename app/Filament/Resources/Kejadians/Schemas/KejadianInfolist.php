<?php

namespace App\Filament\Resources\Kejadians\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KejadianInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('idKelurahan')
                    ->numeric(),
                TextEntry::make('idKecamatan')
                    ->numeric(),
                TextEntry::make('idLaporan')
                    ->numeric(),
                TextEntry::make('idKorban')
                    ->numeric(),
                TextEntry::make('idRegu')
                    ->numeric(),
                TextEntry::make('LokasiKejadian'),
                TextEntry::make('luasTerbakar')
                    ->numeric(),
                TextEntry::make('tanggalKejadian')
                    ->date(),
                TextEntry::make('waktuPenanganan')
                    ->dateTime(),
                TextEntry::make('waktuSelesai')
                    ->dateTime(),
                TextEntry::make('tafsiranKerugian')
                    ->numeric(),
                TextEntry::make('fotoKejadian'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
