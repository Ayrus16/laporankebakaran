<?php

namespace App\Filament\Resources\Laporans\Schemas;

use chillerlan\QRCode\Data\AlphaNum;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Tables\Columns\SelectColumn;

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
                    'diterima' => 'Diterima',
                    'penanganan' => 'Penanganan',
                    'selesai' => 'Selesai',
                    'ditolak' => 'Ditolak',
                ]),


                SpatieMediaLibraryFileUpload::make('fotoLaporan')
                ->collection('fotoLaporan')
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

                // OTOMATIS GEOLOCATION
                // Map::make('location')
                // ->label('Location')
                // ->columnSpanFull()

                // ->liveLocation(true, false, 10000)
                // ->showMyLocationButton(false)

                // ->draggable(false)
                // ->clickable(false)

                // ->dehydrated(false)

                // ->afterStateUpdated(function (Set $set, ?array $state): void {
                //     $set('latitude', $state['lat'] ?? null);
                //     $set('longitude', $state['lng'] ?? null);
                // })

                
                
                
            ]);
    }
}
