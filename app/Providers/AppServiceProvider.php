<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Events\UserSubscribed;
use App\Listeners\SendSubscriberEmail;
use App\Listeners\SendWelcomeMail;
use Illuminate\Support\Facades\Event;
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
        Event::listen(events: UserRegistered::class , listener: SendWelcomeMail::class);
        Event::listen(events: UserSubscribed::class , listener: SendSubscriberEmail::class);



    }

}
