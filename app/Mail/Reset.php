<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Reset extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $code;

    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }


    public function build()
    {
        return $this->subject(__("front.reset email subject"))->view(env("THEME_NAME", "comcash").'.mails.reset')->with("code", $this->code);
    }
}
