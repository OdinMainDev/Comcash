<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemplateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $subject;
    public $template;

    public function __construct($email, $subject, $template)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $this->template = view("admin.mail")->with("template", $this->template)
        ->with("subject", $this->subject)
        ->with("email", $this->email)->render();

        return $this->subject($this->subject)->view('admin.mail')
            ->with("template", $this->template);
    }
}
