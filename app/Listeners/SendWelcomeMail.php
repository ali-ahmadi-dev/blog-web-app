<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


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

        Mail::to($event->user->email)
            ->send(new WelcomeMail(
                $event->user,
                $event->password,   // 👈 الان وجود دارد
                flag: $event->flag
            ));
    }
}
