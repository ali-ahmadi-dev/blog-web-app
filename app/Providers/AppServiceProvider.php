<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
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
        //

        //  Vite::macro('image', fn(string $assets)=>$this->asset("resources/asset/images/{$assets}"));
    
        
        Vite::macro('image', fn(string $assets) => Vite::asset("resources/assets/images/{$assets}"));


    }

}
