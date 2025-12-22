<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriberEmailJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, \Illuminate\Bus\Queueable, SerializesModels;

    public User $user;
    /**
     * Create a new job instance.
     */
    public function __construct( User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::raw('با تشکر از شما بابت عضویت در خبر نامه', function ($message) {
            $message->to($this->user->email);
            $message->subject('عضویت در خبر نامه');
        });
    }
}
