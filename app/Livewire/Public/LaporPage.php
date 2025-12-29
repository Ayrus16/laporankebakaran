<?php

namespace App\Livewire\Public;

use App\Models\Laporan;
use Dotswan\MapPicker\Fields\Map;
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Component;

class LaporPage extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'location' => ['lat' => -6.914744, 'lng' => 107.609810], // Bandung
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
                    ->multiple(),

                        Map::make('location')
                            ->label('Location')
                            ->columnSpanFull()


                            ->liveLocation(true, true, 10000)
                            ->showMyLocationButton(true)

                            ->draggable(false)
                            ->clickable(false)
                            ->defaultLocation(latitude: -6.914744, longitude: 107.609810)

                            // Jangan simpan "location" ke model (hindari error kolom tidak ada)
                            ->dehydrated(false)

                            // Saat lokasi didapat / marker berubah → isi lat/long
                            ->afterStateUpdated(function (Set $set, ?array $state): void {
                                $set('latitude', $state['lat'] ?? null);
                                $set('longitude', $state['lng'] ?? null);
                            })

                            // Saat edit record → set marker dari data yang tersimpan
                            ->afterStateHydrated(function ($state, $record, Set $set): void {
                                if (! $record) return;

                                $set('location', [
                                    'lat' => $record->latitude,
                                    'lng' => $record->longitude,
                                ]);
                            }),


                        ]),

                        TextInput::make('latitude')
                        ->required()->readOnly()->dehydrated(),
                        TextInput::make('longitude')
                        ->required()->readOnly()->dehydrated(),
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

        // ✅ penting: supaya SpatieMediaLibraryFileUpload ikut tersimpan
        $this->form->model($laporan)->saveRelationships();

        // Kalau tetap mau ada info setelah redirect, pakai flash session
        session()->flash('success', 'Laporan berhasil dikirim. Silakan cek laporanmu.');

        // ✅ redirect ke home (pilih salah satu)
        return redirect()->to('/');               // kalau home kamu "/"
        // return redirect()->route('home');      // kalau kamu punya route name "home"
    }

    public function render()
    {
        return view('livewire.public.lapor-page')
        ->layout('components.layouts.public', ['title' => '/lapor']);
    }

    public function refresh(): void
    {
        
    }
}
