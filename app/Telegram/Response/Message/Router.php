<?php

namespace App\Telegram\Response\Message;

use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Helpers\StaticMessages;
use App\Telegram\Response\Callbackquery\Handlers\ExchangePage;
use App\Telegram\Response\Callbackquery\Handlers\SetLanguage;
use App\Telegram\Response\Callbackquery\Handlers\SetRules;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

class Router
{
    use BotFunctions, StaticMessages, SetLanguage, SetRules, ExchangePage;
    
    public $message;
    public $messageText;
    public $user;
    public $bot;
    
    public function __construct($message, $user){
        $this->message = $message;
        $this->messageText = $this->message->getText(true);
        $this->user = $user;
        $this->bot = $user->getBot;
    }

    
    public function exec(){
        if(!$this->checkUserRules()){
            $this->sendRulesMessage($this->user->telegram_id, $this->user->language);
            return;
        }
        if(Config::get("app.telegram_delete_messages")){
            Request::deleteMessage([
                'chat_id'    => $this->message->getFrom()->getId(),
                'message_id' => $this->message->getMessageId(),
            ]);
        }

        $this->doResponse();
    }

    private function doResponse() {
        switch($this->messageText) {
            // Новый обмен
            case __("telegram.bottom_menu_1", [], $this->user->language):
                $this->openExchangePage($this->user->telegram_id, $this->user->language);
                return;
            break;

            // О боте
            case __("telegram.bottom_menu_2", [], $this->user->language):
                $this->sendAboutBotMessage($this->user->telegram_id, $this->user->language);
                return;
            break;

            // Личный кабинет
            case __("telegram.bottom_menu_3", [], $this->user->language):
                $this->sendProfileMessage($this->user->telegram_id, $this->user->language);
                return;
            break;

            // Поддержка
            case __("telegram.bottom_menu_4", [], $this->user->language):
                $this->sendSupportBotMessage($this->user->telegram_id, $this->user->language);
                return;
            break;

            // Сообщество
            case __("telegram.bottom_menu_5", [], $this->user->language):
                $this->sendCommunityBotMessage($this->user->telegram_id, $this->user->language);
                return;
            break;

            default:
                // actions
            break;
        }
    }

}