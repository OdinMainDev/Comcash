<?php

namespace App\Telegram\Response\Callbackquery;

use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Helpers\StaticMessages;
use App\Telegram\Response\Callbackquery\Handlers\SetLanguage;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

class Router
{
    use BotFunctions, StaticMessages, SetLanguage;
    
    public $query;
    public $command;
    public $data;
    public $user;
    public $bot;
    public $notCheckRoutes = ["setLanguage"];
    
    public function __construct($query, $user){
        $this->query = $query;
        $explode = explode(":;:", $query->getData());
        $this->command = $explode[0];
        $this->data = "";
        if(count($explode) > 1)
            $this->data = $explode[1];
        $this->user = $user;
        $this->bot = $user->getBot;
    }

    
    public function exec(){
        if(!in_array($this->command, $this->notCheckRoutes)){
            if(!$this->checkUserRules()){
                $this->sendRulesMessage($this->user->telegram_id, $this->user->language);
                return;
            }
        }
        if(Config::get("app.telegram_delete_messages")){
            Request::deleteMessage([
                'chat_id'    => $this->query->getFrom()->getId(),
                'message_id' => $this->query->getMessage()->getMessageId(),
            ]);
        }
        $this->doResponse();
    }

    private function doResponse() {
        switch($this->command) {
            case "setLanguage":
                $this->setLanguage($this->data);
                if(!$this->checkUserRules()){
                    $this->sendRulesMessage($this->user->telegram_id, $this->user->language);
                    return;
                }
            break;
        }
    }

}