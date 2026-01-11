<?php

namespace App\Livewire\Public;

use App\Models\Laporan;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CekLaporanPage extends Component implements HasForms, HasTable, HasActions
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithActions;

    public ?array $data = [];

    public bool $searched = false;
    public ?string $nama = null;
    public ?string $telepon = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
{
    return $schema
        ->statePath('data')
        ->components([
            TextInput::make('namaPelapor')
                ->label('Nama Pelapor')
                ->required()
                ->minLength(3)
                ->maxLength(100),

            TextInput::make('tlpPelapor')
                ->label('Nomor Telepon')
                ->numeric()
                ->prefix('+62')
                ->required()
                ->minLength(9)
                ->maxLength(15)
                ->placeholder('8xxxxxxxxxx'),
        ]);
}

    public function cek(): void
    {
        // validasi berdasarkan rules dari komponen Filament
        $this->form->validate();

        $state = $this->form->getState();

        $this->nama = trim((string) ($state['namaPelapor'] ?? ''));
        $this->telepon = preg_replace('/\s+/', '', (string) ($state['tlpPelapor'] ?? ''));

        $this->searched = true;

        // reset pagination table supaya kembali ke page 1 ketika cari ulang
        $this->resetPage('tablePage');
    }

    protected function laporanQuery(): Builder
    {
        return Laporan::query()
            // sebelum search, kosongkan hasil (biar nggak bocor data)
            ->when(! $this->searched, fn (Builder $q) => $q->whereRaw('1=0'))
            // setelah search, wajib match nama + telepon (lebih aman daripada LIKE)
            ->when($this->searched, function (Builder $q) {
                $q->whereRaw('LOWER("namaPelapor") = ?', [mb_strtolower($this->nama ?? '')])
                  ->where('tlpPelapor', $this->telepon);
            })
            ->latest();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(fn () => $this->laporanQuery())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('namaPelapor')
                    ->label('Nama Pelapor')
                    ->searchable(false),

                TextColumn::make('tlpPelapor')
                    ->label('No. Telepon'),

                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(40)
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'diterima' => 'success',
                        'penanganan' => 'warning',
                        'selesai' => 'gray',
                        'ditolak' => 'danger',
                    }),
            ])
            ->paginated([5, 10, 25])
            ->emptyStateHeading(fn () => $this->searched
                ? 'Laporan tidak ditemukan'
                : 'Masukkan nama & nomor telepon untuk cek laporan'
            )
            ->emptyStateDescription(fn () => $this->searched
                ? 'Pastikan nama dan nomor telepon sama persis seperti saat melapor.'
                : 'Hasil akan muncul dalam bentuk tabel.'
            );
    }

    public function render()
    {
        return view('livewire.public.cek-laporan-page')
        ->layout('components.layouts.public', ['title' => 'Cek Laporan']);
    }
}
