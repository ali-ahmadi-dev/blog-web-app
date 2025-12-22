<?php

namespace App\Listeners;

use App\Events\UserSubscribed;
use App\Jobs\SendSubscriberEmailJob;


class SendSubscriberEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSubscribed $event): void
    {

        // Job را dispatch می‌کنیم و 15 ثانیه delay می‌دهیم
        SendSubscriberEmailJob::dispatch($event->user)->delay(now()->addSeconds(15));
    }
}
