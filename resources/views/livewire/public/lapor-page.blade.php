<div class="flex flex-col items-center gap-6">
    

    <div class="w-full max-w-md border rounded-md p-6">
        <form wire:submit="submit" class="space-y-4" enctype="multipart/form-data">
            {{ $this->form }}


            <button type="submit" wire:loading.attr="disabled" class="w-full rounded-md py-2 text-sm font-semibold text-[#0B133B] bg-[#C8892A]">
                <span wire:loading.remove>Kirim</span>
                <span wire:loading>Mengirim...</span>
            </button>

            {{-- <button type="submit"
                    class="w-full rounded-md py-2 text-sm font-semibold text-[#0B133B] bg-[#C8892A]">
                Laporkan Kejadian!
            </button> --}}
        </form>
    </div>

    <x-filament-actions::modals />
</div>
