<?php

namespace App\Livewire\Public;

use App\Models\Laporan;
use Dotswan\MapPicker\Fields\Map;
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;
use Livewire\WithFileUploads;


class LaporPage extends Component implements HasSchemas
{
    use InteractsWithSchemas,WithFileUploads;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'location' => ['lat' => -6.2297209, 'lng' => 106.664704], // Default Bandung
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                    Section::make('')->schema([
                        TextInput::make('namaPelapor')
                        ->label('Nama Pelapor')
                        ->minLength(3)
                        ->required(),
                    TextInput::make('tlpPelapor')
                        ->label('Nomor Pelapor')
                        ->minLength(9)
                        ->prefix(+62)
                        ->numeric()
                        ->required(),
                    TextInput::make('alamat')
                        ->label('Alamat Kejadian'),
                    
                    
                    SpatieMediaLibraryFileUpload::make('fotoLaporan')
                        ->collection('fotoLaporan')
                        ->disk('public')
                        ->image()
                        ->multiple(),

                        Map::make('location')
                            ->label('Location')
                            ->columnSpanFull()


                            ->liveLocation(true, true, 10000)
                            ->showMyLocationButton(true)

                            ->draggable(false)
                            ->clickable(false)
                            ->defaultLocation(latitude: -6.2297209, longitude: 106.664704)
                            ->dehydrated(false)

                            // Update Map saat lokasi di dapat
                            ->afterStateUpdated(function (Set $set, ?array $state): void {
                                $set('latitude', $state['lat'] ?? null);
                                $set('longitude', $state['lng'] ?? null);
                            })

                            ->afterStateHydrated(function ($state, $record, Set $set): void {
                                if (! $record) return;

                                $set('location', [
                                    'lat' => $record->latitude,
                                    'lng' => $record->longitude,
                                ]);
                            }),

                        TextInput::make('latitude')
                        ->required()->readOnly()->dehydrated(),
                        TextInput::make('longitude')
                        ->required()->readOnly()->dehydrated(),


                        ]),

                        
                    ])
                    ->statePath('data')
                    ->model(Laporan::class);
            }

    public function submit(): mixed
    {
        $state = $this->form->getState();

        $laporan = Laporan::create([
            'namaPelapor' => $state['namaPelapor'],
            'tlpPelapor'  => $state['tlpPelapor'],
            'alamat'      => $state['alamat'],
            'latitude'    => $state['latitude'] ?? null,
            'longitude'   => $state['longitude'] ?? null,
            'status'      => 'diterima',
        ]);

        $files = $state['fotoLaporan'] ?? [];

        foreach ((array) $files as $file) {
            $laporan
                ->addMedia($file) 
                ->toMediaCollection('fotoLaporan', 'public');
        }

        $this->form->model($laporan)->saveRelationships();

        session()->flash('success', 'Laporan berhasil dikirim. Silakan cek laporanmu.');

        
        return redirect()->to('/cek-laporan');
    }

    public function render()
    {
        return view('livewire.public.lapor-page')
        ->layout('components.layouts.public', ['title' => 'lapor Kejadian']);
    }

    public function refresh(): void
    {
        
    }
}
