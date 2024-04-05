<?php

namespace App\Telegram\Helpers;

use Illuminate\Validation\ValidationException;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

class RegisterWebhook
{

    public $bot;

    public function __construct($bot){
        $this->bot = $bot;
    }

    public function process(){
        try {
            $telegram = new Telegram($this->bot->token, $this->bot->username);

            $data = [
                'max_connections' => 200
            ];
            if(env("APP_IP_ADDRESS", false)) {
                $data['ip_address'] = env("APP_IP_ADDRESS", false);
            }
            $result = $telegram->setWebhook(route("telegramBotWebhook", [$this->bot->id]), $data);
            if (!$result->isOk()) {
                $this->bot->delete();
                throw ValidationException::withMessages(["id" => $result->getDescription()]);
            }
            
        } catch (TelegramException $e) {
            $this->bot->delete();
            throw ValidationException::withMessages(["id" => $result->getDescription()]);
        }
        return $this->bot;
    }
}