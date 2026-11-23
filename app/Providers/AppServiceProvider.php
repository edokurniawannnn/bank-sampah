<?php

namespace App\Providers;

use App\Models\Setoran;
use App\Observers\SetoranObserver;
use Illuminate\Support\ServiceProvider;

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
    // app/Providers/AppServiceProvider.php
    public function boot(): void
    {
        Setoran::observe(SetoranObserver::class);
    }
}
