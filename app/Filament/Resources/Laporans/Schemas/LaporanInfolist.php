<?php

namespace App\Filament\Resources\Laporans\Schemas;

use Dotswan\MapPicker\Infolists\MapEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Pelapor')
                ->columns(2)
                ->schema([
                    TextEntry::make('namaPelapor')->label('Nama pelapor'),
                    TextEntry::make('tlpPelapor')->label('Nomor pelapor'),
                ]),

            Section::make('Informasi Kejadian')
                ->columns(1)
                ->schema([
                    TextEntry::make('alamat')->label('Alamat Kejadian'),
                ]),

            Section::make('Koordinat')
                ->columns(2)
                ->schema([
                    TextEntry::make('latitude'),
                    TextEntry::make('longitude'),
                ]),

            TextEntry::make('status')
                ->label('Status Laporan')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                        'diterima' => 'success',
                        'penanganan' => 'warning',
                        'selesai' => 'gray',
                        'ditolak' => 'danger',
                }),

            TextEntry::make('created_at')->label('Dilaporkan Pada')->dateTime(),
            TextEntry::make('updated_at')->dateTime(),

            Section::make('Dokumentasi Foto')
                ->columns(2)
                ->columnSpanFull()
                ->schema([
                    SpatieMediaLibraryImageEntry::make('fotoLaporan')
                        ->label('Foto Laporan')
                        ->collection('fotoLaporan')
                        ->disk('public')
                        ->imageHeight(500)
                        ->square(false)
                        ->stacked(),
                ]),

            Section::make('Lokasi')
                ->columnSpanFull()
                ->schema([
                    MapEntry::make('location')
                        ->label('Peta Lokasi')
                        // ambil dari kolom latitude/longitude (wajib format lat/lng)
                        ->state(fn ($record) => [
                            'lat' => $record?->latitude ? (float) $record->latitude : -6.914744,
                            'lng' => $record?->longitude ? (float) $record->longitude : 107.609810,
                        ])
                        ->defaultLocation(latitude: -6.914744, longitude: 107.609810)
                        ->draggable(true)
                        ->clickable(false)
                        ->showMarker(true)
                        ->zoom(16)
                        // cegah request icon fullscreen.png (opsional tapi membantu)
                        ->showFullscreenControl(true)
                        ->extraStyles([
                            'min-height: 360px',
                            'border-radius: 12px',
                        ])
                        ->tilesUrl('https://tile.openstreetmap.org/{z}/{x}/{y}.png')
                        ->detectRetina(true)
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
