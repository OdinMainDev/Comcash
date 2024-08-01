<?php

namespace App\Jobs;

use App\Mail\Register;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class OnRegister implements ShouldQueue
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
        $this->user = User::where("id", $this->user_id)->first();
        Lang::setLocale($this->language);
        // Mail::to($this->user->email)->send(new Register($this->user->id, $this->user->email));
    }
}
