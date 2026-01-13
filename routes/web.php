<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\LaporPage;
use App\Livewire\Public\CekLaporanPage;
use Livewire\Mechanisms\HandleRequests\HandleRequests;

Route::view('/', 'public.home')->name('public.home');


Route::get('/lapor', LaporPage::class)->name('public.lapor')->middleware('throttle:60,1');
Route::get('/cek-laporan', CekLaporanPage::class)->name('public.cek');

// Route::post('/livewire/update', HandleRequests::class)
//     ->middleware('throttle:lapor-submit');


