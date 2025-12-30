<div class="mx-auto w-full max-w-3xl space-y-6">
    <x-filament::section>
        <x-slot name="heading">Cek Laporan Kebakaran</x-slot>
        <x-slot name="description">
            Masukkan nama dan nomor telepon yang digunakan saat melapor.
        </x-slot>

        <form wire:submit.prevent="cek" class="space-y-4">
            {{ $this->form }}

            <div class="flex justify-end">
                <x-filament::button type="submit" icon="heroicon-m-magnifying-glass">
                    Cek Laporan
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>

    <x-filament::section>   
        {{ $this->table }}
    </x-filament::section>
</div>
