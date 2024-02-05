<?php

namespace App\Services\Bot\Response;

use App\Http\Traits\Models\HasTelegramBot;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use App\Services\Bot\Handlers\Handler;
use App\Services\Bot\Translate;
use Longman\TelegramBot\Request;
use App\Services\Bot\Keyboard;
use App\Services\Bot\Response\Callbackquery\Router;
use App\Telegram\Helpers\BotConstructor;
use App\Telegram\Helpers\Keyboards;

class CallbackqueryCommand extends SystemCommand
{
    use HasTelegramBot, BotConstructor, Keyboards;

    protected $name = 'callbackquery';
    protected $description = 'Handle the callback query';
    protected $version = '1.2.0';

    public function execute(): ServerResponse
    {
        $callback_query = $this->getCallbackQuery();
        $user = $this->getUserBotModel($callback_query->getFrom(), $this->constructBotData());
        $language = $user->language;

        $bot = $user->getBot;

        
        // $response = new Router($callback_query, $user);
        // $response->exec();
        
        return $callback_query->answer([
            'text'       => __("telegram.loading"),
            'show_alert' => false,
            'cache_time' => 5,
        ]);
    }
}