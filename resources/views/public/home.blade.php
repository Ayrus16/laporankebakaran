<x-layouts.public title="Home">
    <div class="min-h-[calc(100vh-4rem)] flex flex-col items-center justify-center">
        <a href="{{ route('public.lapor') }}"
           class="group relative flex h-44 w-44 sm:h-52 sm:w-52 items-center justify-center rounded-full
                  bg-[#C8892A]
                  shadow-[0_10px_25px_rgba(0,0,0,0.35),0_0_0_6px_rgba(0,0,0,0.18),0_0_50px_rgba(200,137,42,0.25)]
                  ring-1 ring-black/25
                  transition hover:scale-[1.02] active:scale-[0.99]">
            <span class="text-[#0B133B] font-extrabold tracking-wide text-xl sm:text-2xl">
                LAPOR
            </span>
        </a>

        <p class="mt-8 text-center text-white/70 text-sm leading-5">
            Laporkan<br>
            Kejadian Kebakaran
        </p>
    </div>
</x-layouts.public>

