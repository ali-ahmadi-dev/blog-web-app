<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Jobs\SendWelcomeMailJob;


class SendWelcomeMail
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
    public function handle(UserRegistered $event): void
    {


        SendWelcomeMailJob::dispatch($event->user , $event->password,   $event->flag)->delay(now()->addSeconds(8));;
    }
}
