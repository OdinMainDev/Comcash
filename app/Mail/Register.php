<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
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
        return $this->subject(__("front.register email subject"))->view(env("THEME_NAME", "comcash").'.mails.register')->with("url", route("verifyEmail", [
            "id" => $this->user_id, 
            "hash" => md5($this->user_id.$this->email."VerifyCmHash")
        ]));
    }
}
