<?php

namespace App\Jobs;

use App\Mail\Reset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class OnReset implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
    public $user_id;
    public $user;
    public $language;
    public $code;

    public function __construct($user_id, $language, $code)
    {
        $this->user_id = $user_id;
        $this->language = $language;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user = User::where("id", $this->user_id)->first();
        Lang::setLocale($this->language);
        @Mail::to($this->user->email)->send(new Reset($this->user->email, $this->code));
    }
}
