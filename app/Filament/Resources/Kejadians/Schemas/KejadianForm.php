<?php

namespace App\Filament\Resources\Kejadians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

// Layout components (v4) ✅
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

// Spatie Media Library upload (pastikan plugin-nya terpasang)
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class KejadianForm
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
                                    TextInput::make('LokasiKejadian')
                                        ->label('Lokasi Kejadian')
                                        ->required()
                                        ->columnSpanFull(),

                                    DatePicker::make('tanggalKejadian')
                                        ->label('Tanggal Kejadian'),

                                    Textarea::make('keteranganTambahan')
                                        ->label('Keterangan Tambahan')
                                        ->rows(4)
                                        ->columnSpanFull(),

                                    Textarea::make('penyebabKebakaran')
                                        ->label('Penyebab Kebakaran')
                                        ->rows(4)
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Dokumentasi Foto')
                                ->schema([
                                    SpatieMediaLibraryFileUpload::make('fotoKejadian')
                                        ->label('Foto Kejadian')
                                        ->collection('fotoKejadian')
                                        ->disk('public')
                                        ->image()
                                        ->multiple()
                                        ->maxFiles(10)
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Tab::make('Penanganan')
                        ->schema([
                            Section::make('Waktu')
                                ->columns(2)
                                ->schema([
                                    DateTimePicker::make('waktuPenanganan')
                                        ->label('Waktu Penanganan'),

                                    DateTimePicker::make('waktuSelesai')
                                        ->label('Waktu Selesai'),
                                ]),

                            Section::make('Regu')
                                ->schema([
                                    Textarea::make('infoRegu')
                                        ->label('Catatan')
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->default('Regu dikelola lewat Relation Manager (bisa lebih dari 1).')
                                        ->rows(2),
                                ]),
                        ]),

                    Tab::make('Kerugian & Korban')
                        ->schema([
                            Section::make('Kerugian')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('luasTerbakar')
                                        ->label('Luas Terbakar')
                                        ->numeric()
                                        ->suffix('m²')
                                        ->minValue(0),

                                    TextInput::make('tafsiranKerugian')
                                        ->label('Tafsiran Kerugian')
                                        ->numeric()
                                        ->prefix('Rp')
                                        ->minValue(0),
                                ]),

                            Section::make('Korban')
                                ->schema([
                                    Textarea::make('infoKorban')
                                        ->label('Catatan')
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->default('Korban dicatat lewat Relation Manager (bisa lebih dari 1).')
                                        ->rows(2),
                                ]),
                        ]),
                ]),
        ]);
    }
}
