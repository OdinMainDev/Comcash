<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExchangeComplete extends Mailable
{
    use Queueable, SerializesModels;


    public $user_id;
    public $email;
    public $exchange;

    public function __construct($user_id, $email, $exchange)
    {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->exchange = $exchange;
    }


    public function build()
    {
        return $this->subject(__("emails.subject_exchange_complete"))->view(env("THEME_NAME", "comcash").'.mails.exchange_complete')
        ->with("id", $this->exchange->id)
        ->with("currencyFrom", $this->exchange->currencyFrom->getTitle())
        ->with("currencyTo", $this->exchange->currencyTo->getTitle())
        ->with("amountFrom", $this->exchange->data['amount_data']['amount_send'])
        ->with("amountTo", $this->exchange->data['amount_data']['amount_receive'])
        ->with("url", route("exchgangePage2", [
            "locale" => app()->getLocale(),
            "hash" => $this->exchange->hash
        ]));
    }
}
