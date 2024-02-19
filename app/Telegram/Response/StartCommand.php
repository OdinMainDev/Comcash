<?php

namespace App\Telegram\Response;

use App\Http\Traits\Models\HasTelegramBot;
use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Helpers\KeyboardGenerator;
use App\Telegram\Helpers\Keyboards;
use App\Telegram\Helpers\StaticMessages;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class StartCommand extends SystemCommand
{
    use HasTelegramBot, BotFunctions, Keyboards, StaticMessages;

    protected $name = 'start';
    protected $description = 'Start command';
    protected $usage = '/start';
    protected $version = '1.2.0';
    protected $private_only = true;

    public function execute(): ServerResponse
    {
        $user = $this->getUserBotModel($this->getMessage()->getFrom(), $this->constructBotData());
        $affiliateCampaignUser = $this->getMessage()->getText(true);
        info($affiliateCampaignUser);
        $language = $user->language;
        $user->action = 0;
        $user->save();

        if(Config::get("app.telegram_delete_messages")){
            Request::deleteMessage([
                'chat_id'    => $this->getMessage()->getFrom()->getId(),
                'message_id' => $this->getMessage()->getMessageId(),
            ]);
        }

        // если пользователь только что зарегался то отправляем изначально ему кейборд с выбором языка
        if(count(Config::get("app.languages")) > 1 && $user->IsNowRegistered){
            $this->sendLanguageMessage($user->telegram_id, $language, KeyboardGenerator::generate($this->keyboardLanguages($language)));
            return Request::emptyResponse();
        }

        // если правила не приняты правила то отправляем их
        if(!$user->is_rules_accepted){
            $this->sendRulesMessage($user->telegram_id, $language);
            return Request::emptyResponse();
        }

        // правил в проекте нет то тогда
        // отправляем приветственное сообщение с главным меню
        $this->sendMainMenu($user->telegram_id, $language);
        return Request::emptyResponse();
    }
}