<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Kejadian;
use App\Policies\KejadianPolicy;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Kejadian::class, KejadianPolicy::class);

        RateLimiter::for('lapor-submit', function (Request $request) {
        $key = sha1(($request->ip() ?? 'na') . '|' . substr((string) $request->userAgent(), 0, 120));

        // limit 5 laporan dalam 2 menit
        return Limit::perMinutes(3, 5)->by($key);
    });

    }
    
}
