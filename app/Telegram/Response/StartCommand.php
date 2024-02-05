<?php

namespace App\Services\Bot\Response;

use App\Http\Traits\Models\HasTelegramBot;
use App\Telegram\Helpers\BotConstructor;
use App\Telegram\Helpers\KeyboardGenerator;
use App\Telegram\Helpers\Keyboards;
use App\Telegram\Helpers\StaticMessages;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class StartCommand extends SystemCommand
{
    use HasTelegramBot, BotConstructor, Keyboards, StaticMessages;

    protected $name = 'start';
    protected $description = 'Start command';
    protected $usage = '/start';
    protected $version = '1.2.0';
    protected $private_only = true;

    public function execute(): ServerResponse
    {
        $user = $this->getUserBotModel($this->getMessage()->getFrom(), $this->constructBotData());
        $language = $user->language;

        // если пользователь только что зарегался то отправляем изначально ему кейборд с выбором языка
        if(count(Config::get("app.languages")) > 1 && $user->IsNowRegistered){
            $text = __("telegram.choose_language", [], $language);
            $keyboard = KeyboardGenerator::generate($this->keyboardLanguages($language));
            return $this->replyToChat(
                $text,
                [
                    'reply_markup' => $keyboard,
                ]
            );
        }

        // если правила не приняты правила то отправляем их
        if(!$user->is_rules_accepted){
            $text = __("telegram.rules", [], $language);
            return $this->replyToChat(
                $text,
                [
                    'reply_markup' => KeyboardGenerator::generate($this->keyboardRules($language)),
                ]
            );
        }

        // правил в проекте нет то тогда
        // отправляем приветственное сообщение с главным меню
        $this->sendMainMenu($user->telegram_id, $language);
        return Request::emptyResponse();
    }
}