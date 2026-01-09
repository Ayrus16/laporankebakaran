<?php

namespace App\Filament\Resources\Kejadians\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KorbansRelationManager extends RelationManager
{
    protected static string $relationship = 'korbans';
    protected static ?string $title = 'Korban';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nik')
                ->label('NIK')
                ->maxLength(16)
                ->required(),

            TextInput::make('namaLengkap')
                ->label('Nama Lengkap')
                ->required(),

            Select::make('jenisKelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])
                ->required(),

            Textarea::make('alamat')
                ->label('Alamat')
                ->rows(3)
                ->nullable(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'selamat' => 'Selamat',
                    'luka' => 'Luka',
                    'meninggal' => 'Meninggal',
                ])
                ->nullable(),

            Textarea::make('keterangan')
                ->label('Keterangan')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('namaLengkap')
            ->columns([
                TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),

                TextColumn::make('namaLengkap')
                    ->label('Nama')
                    ->searchable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Korban'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
