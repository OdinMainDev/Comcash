<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user_id;
    public $email;

    public function __construct($user_id, $email)
    {
        $this->user_id = $user_id;
        $this->email = $email;
    }


    public function build()
    {
        return $this->subject(__("emails.subject_verify_email"))->view(env("THEME_NAME", "comcash").'.mails.verify_email')->with("url", route("verifyEmail", [
            "locale" => app()->getLocale(),
            "id" => $this->user_id, 
            "hash" => md5($this->user_id.$this->email."VerifyCmHash")
        ]));
    }
}
