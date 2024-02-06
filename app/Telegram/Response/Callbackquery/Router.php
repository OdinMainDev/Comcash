<?php

namespace App\Telegram\Response\Callbackquery;

use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Helpers\StaticMessages;
use App\Telegram\Response\Callbackquery\Handlers\ProfileActions;
use App\Telegram\Response\Callbackquery\Handlers\SetLanguage;
use App\Telegram\Response\Callbackquery\Handlers\SetRules;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

class Router
{
    use BotFunctions, StaticMessages, SetLanguage, SetRules, ProfileActions;
    
    public $query;
    public $command;
    public $data;
    public $user;
    public $bot;
    public $notCheckRoutes = ["setLanguage", "setRules"];
    
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

            case "setRules":
                if(!$this->setRules($this->data)){
                    $this->sendRulesMessage($this->user->telegram_id, $this->user->language);
                    $this->sendDeclineRulesMessage($this->user->telegram_id, $this->user->language);
                    return;
                }

                $this->sendMainMenu($this->user->telegram_id, $this->user->language);
                return;
            break;

            case "gotoWeb":
                $this->profileGoToWeb($this->user->telegram_id, $this->user->language, $this->user->getUser->id);
                return;
            break;

            case "openProfile":
                $this->sendProfileMessage($this->user->telegram_id, $this->user->language);
                return;
            break;

            case "openMainMenu":
                $this->sendMainMenu($this->user->telegram_id, $this->user->language);
                return;
            break;
        }
    }

}