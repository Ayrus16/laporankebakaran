<?php

namespace App\Filament\Resources\Kejadians\Schemas;


use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class KejadianInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('KejadianTabs')
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Informasi Kebakaran')
                        ->schema([
                            Section::make('Informasi Kejadian')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('LokasiKejadian')->label('Lokasi Kejadian')->columnSpanFull(),
                                    TextEntry::make('tanggalKejadian')->label('Tanggal Kejadian')->date()->placeholder('-'),
                                    TextEntry::make('keteranganTambahan')->label('Keterangan Tambahan')->columnSpanFull()->placeholder('-'),
                                    TextEntry::make('penyebabKebakaran')->label('Penyebab Kebakaran')->columnSpanFull()->placeholder('-'),
                                ]),
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

                            
                        ]),

                    Tab::make('Penanganan')
                        ->schema([
                            Section::make('Waktu')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('waktuPenanganan')->label('Waktu Penanganan')->dateTime()->placeholder('-'),
                                    TextEntry::make('waktuSelesai')->label('Waktu Selesai')->dateTime()->placeholder('-'),
                                ]),
                        ]),

                    Tab::make('Kerugian & Korban')
                        ->schema([
                            Section::make('Kerugian')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('luasTerbakar')->label('Luas Terbakar')->suffix(' m²')->placeholder('-'),
                                    TextEntry::make('tafsiranKerugian')->label('Tafsiran Kerugian')->money('IDR')->placeholder('-'),
                                ]),
                        ]),
                ]),
        ]);
    }
}
