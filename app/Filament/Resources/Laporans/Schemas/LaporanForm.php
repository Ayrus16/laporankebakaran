<?php

namespace App\Filament\Resources\Laporans\Schemas;

use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use App\Models\Laporan;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('namaPelapor')
                    ->label('Nama Pelapor')
                    ->required(),
                TextInput::make('tlpPelapor')
                    ->label('Nomor Pelapor')
                    ->prefix('0')
                    ->numeric()
                    ->required(),
                TextInput::make('alamat')
                    ->label('Alamat Kejadian')
                    ->required(),
                TextInput::make('latitude')
                    ->required()->readOnly(),
                TextInput::make('longitude')
                    ->required()->readOnly(),
                
                Select::make('status')
                    ->options([
                        'diterima'    => 'Diterima',
                        'penanganan'  => 'Penanganan',
                        'selesai'     => 'Selesai',
                        'ditolak'     => 'Ditolak',
                    ])
                    ->required()
                    ->disabled(function (?Laporan $record): bool {
                        return $record?->kejadians()->exists() ?? false;
                    })
                    ->helperText(function (?Laporan $record): ?string {
                        return ($record?->kejadians()->exists() ?? false)
                            ? 'Laporan Sudah Memiliki Kejadian'
                            : null;
                    }),


                SpatieMediaLibraryFileUpload::make('fotoLaporan')
                ->collection('fotoLaporan')
                ->image()
                ->disk('public')
                ->multiple(),

                Map::make('location')
                ->label('Pilih Titik Lokasi')
                ->columnSpanFull()
                ->defaultLocation(latitude: -6.914744, longitude: 107.609810) //Bandung
                ->zoom(15)
                ->showMarker(true)
                ->draggable(true)
                ->clickable(true)
                ->dehydrated(false)
                ->afterStateUpdated(function ($set, ?array $state): void {
                    $set('latitude', $state['lat'] ?? null);
                    $set('longitude', $state['lng'] ?? null);
                })
                ->afterStateHydrated(function ($state, $record, $set): void {
                    // edit data tetap tersimpan
                    $set('location', [
                        'lat' => $record?->latitude,
                        'lng' => $record?->longitude,
                    ]);
                }),
              
            ]);
    }
}
