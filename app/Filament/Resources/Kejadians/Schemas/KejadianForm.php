<?php

namespace App\Filament\Resources\Kejadians\Schemas;

use App\Models\Kelurahan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

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
                                    Select::make('idKecamatan')
                                        ->relationship(name: 'kecamatan', titleAttribute: 'namaKecamatan')
                                        ->label('Kecamatan')
                                        ->searchable()
                                        ->preload()
                                        ->live() 
                                        ->afterStateUpdated(function (Set $set) {
                                            $set('idKelurahan', null);
                                        })
                                        ->required(),

                                    Select::make('idKelurahan')
                                        ->label('Kelurahan')
                                        ->options(fn (Get $get) => blank($get('idKecamatan'))
                                            ? []
                                            : Kelurahan::query()
                                                ->where('idKecamatan', $get('idKecamatan'))
                                                ->orderBy('namaKelurahan')
                                                ->pluck('namaKelurahan', 'id')
                                                ->toArray()
                                        )
                                        ->searchable()
                                        ->preload()
                                        ->disabled(fn (Get $get) => blank($get('idKecamatan')))
                                        ->required(),

                                    TextInput::make('LokasiKejadian')
                                        ->label('Lokasi Kejadian')
                                        ->required()
                                        ->columnSpanFull(),

                                    DatePicker::make('tanggalKejadian')
                                        ->label('Tanggal Kejadian'),

                                    Select::make('status')
                                        ->label('Status Kejadian')
                                        ->options([
                                            'penanganan' => 'Penanganan',
                                            'selesai'    => 'Selesai',
                                        ])
                                        ->default('penanganan')
                                        ->required()
                                        ->live(),



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
