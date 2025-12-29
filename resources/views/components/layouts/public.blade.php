@props(['title' => 'APP'])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">
    {{-- Navbar --}}
    <header class="sticky top-0 z-50 bg-[#030B2A]">
        <div class="mx-auto max-w-6xl px-4 h-16 grid grid-cols-[1fr_auto_1fr] items-center">
            {{-- Left: Logo --}}
            <a href="{{ route('public.home') }}"
               class="justify-self-start text-white font-bold text-lg tracking-wide hover:opacity-90">
                AppLapor
            </a>

            {{-- Center menu --}}
            <nav class="justify-self-center flex items-center gap-2 sm:gap-3 text-sm">
                <a href="{{ route('public.lapor') }}"
                   class="px-3 py-2 rounded-lg font-semibold transition
                          {{ request()->routeIs('public.lapor')
                                ? 'text-white bg-white/10'
                                : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Lapor
                </a>

                <a href="{{ route('public.cek') }}"
                   class="px-3 py-2 rounded-lg font-semibold transition
                          {{ request()->routeIs('public.cek')
                                ? 'text-white bg-white/10'
                                : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                    Cek Laporan
                </a>
            </nav>

            {{-- Right: Button (ke admin) --}}
            <div class="justify-self-end">
                <a href="/admin"
                   class="inline-flex items-center rounded-lg px-3 py-2 text-xs font-semibold
                          text-white border border-white/20 hover:bg-white/10 transition">
                    Admin
                </a>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="mx-auto max-w-6xl px-4 py-10">
        {{ $slot }}
    </main>

    {{-- Notifikasi Filament --}}
    @livewire('notifications')
    @filamentScripts
</body>
</html>
