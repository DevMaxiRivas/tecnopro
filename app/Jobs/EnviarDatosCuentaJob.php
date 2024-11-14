<?php

namespace App\Jobs;

use App\Mail\EnviarDatosCuentaMailable;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnviarDatosCuentaJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;
    public $passwordTextPlain;

    public function __construct($user, $passwordTextPlain)
    {
        $this->user = $user;
        $this->passwordTextPlain = $passwordTextPlain;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new EnviarDatosCuentaMailable($this->user, $this->passwordTextPlain));
    }
}
