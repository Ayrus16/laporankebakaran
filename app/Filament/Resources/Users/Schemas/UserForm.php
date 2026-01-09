<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Regu;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                Step::make('Akun')
                    ->schema([
                        TextInput::make('name')->required(),

                        TextInput::make('email')
                            ->email()
                            ->required(),

                        TextInput::make('password')
                            ->password()
                            ->required(fn (string $operation) => $operation === 'create')
                            ->dehydrateStateUsing(fn (?string $state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn (?string $state) => filled($state)),
                    ]),

                Step::make('Penempatan')
                    ->schema([
                        Select::make('roles')
                            ->label('Role')
                            ->relationship('roles', 'name')                   
                            ->preload()
                            ->required(),

                        Select::make('idKantor')
                            ->label('Kantor')
                            // Select relationship() untuk BelongsTo memang cara resminya di Filament 4 :contentReference[oaicite:1]{index=1}
                            ->relationship(name: 'kantor', titleAttribute: 'namaKantor') // sesuaikan kolom
                            ->searchable()
                            ->preload()
                            ->live() // penting: supaya perubahan meng-update field lain :contentReference[oaicite:2]{index=2}
                            ->afterStateUpdated(fn (Set $set) => $set('idRegu', null))
                            ->required(),

                        Select::make('idRegu')
                            ->label('Regu')
                            ->searchable()
                            ->preload()
                            ->disabled(fn (Get $get) => blank($get('idKantor')))
                            ->options(function (Get $get): array {
                                $idKantor = $get('idKantor');

                                if (blank($idKantor)) {
                                    return [];
                                }

                                return Regu::query()
                                    ->where('idKantor', $idKantor)
                                    ->orderBy('namaRegu')
                                    ->pluck('namaRegu', 'id')
                                    ->all();
                            })
                            ->rules([
                                fn (Get $get) => Rule::exists('regus', 'id')
                                    ->where('idKantor', $get('idKantor')),
                            ])
                            ->required(),
                    ]),

                Step::make('Status')
                    ->schema([
                        TextInput::make('noteleponPetugas')
                            ->label('No. Telepon')
                            ->maxLength(30),

                        Toggle::make('isActive')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ]),
        ]);
    }
}
