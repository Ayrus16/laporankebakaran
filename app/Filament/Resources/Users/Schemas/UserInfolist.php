<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Akun')
                ->columns(2)
                ->schema([
                    TextEntry::make('name')
                        ->label('Nama')
                        ->placeholder('-'),

                    TextEntry::make('email')
                        ->label('Email')
                        ->placeholder('-'),

                ]),

            Section::make('Penempatan')
                ->columns(2)
                ->schema([
                    TextEntry::make('kantor.namaKantor')
                        ->label('Kantor')
                        ->placeholder('-'),

                    TextEntry::make('regu.namaRegu')
                        ->label('Regu')
                        ->placeholder('-'),

                    TextEntry::make('noteleponPetugas')
                        ->label('No. Telepon Petugas')
                        ->placeholder('-')
                        ->columnSpanFull(),
                ]),

            Section::make('Metadata')
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')
                        ->label('Dibuat Pada')
                        ->dateTime()
                        ->placeholder('-'),

                    TextEntry::make('updated_at')
                        ->label('Diubah Pada')
                        ->dateTime()
                        ->placeholder('-'),
                ]),
        ]);
    }
}
