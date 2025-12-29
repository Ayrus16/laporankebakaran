<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\LaporPage;
use App\Livewire\Public\CekLaporanPage;


Route::view('/', 'public.home')->name('public.home');


Route::get('/lapor', LaporPage::class)->name('public.lapor');
Route::get('/cek-laporan', CekLaporanPage::class)->name('public.cek');


