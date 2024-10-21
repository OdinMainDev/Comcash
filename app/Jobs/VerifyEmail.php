<?php

namespace App\Jobs;

use App\Mail\Reset;
use App\Mail\VerifyEmail as MailVerifyEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class VerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
    public $user_id;
    public $user;
    public $language;

    public function __construct($user_id, $language)
    {
        $this->user_id = $user_id;
        $this->language = $language;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Lang::setLocale($this->language);
        $this->user = User::where("id", $this->user_id)->first();
        if(!$this->user){ 
            return;
        }
        @Mail::to($this->user->email)->send(new MailVerifyEmail($this->user->id, $this->user->email));
    }
}
