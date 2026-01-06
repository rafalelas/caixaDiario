<?php

namespace App\Providers;
use Carbon\Carbon;

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
    public function boot(): void
    {
        Carbon::setLocale('pt_BR');

        if(auth()->check()){
            $tz = auth()->user()->preferences['timezone'] ?? config('app.timezone');
            config(['app.timezone' => $tz]);
            date_default_timezone_set($tz);
            Carbon::setLocale(app()->getLocale());
        }
    }
}
