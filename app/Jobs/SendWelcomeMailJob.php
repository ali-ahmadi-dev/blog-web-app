<?php

namespace App\Jobs;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendWelcomeMailJob implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public User $user;
    public string $password;
    public bool $flag;

    public function __construct( User $user, string $password, bool $flag)
    {
        $this->user = $user;
        $this->password = $password;
        $this->flag = $flag;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->user->email)->send(new WelcomeMail($this->user, $this->password, flag: $this->flag));
    }
}
