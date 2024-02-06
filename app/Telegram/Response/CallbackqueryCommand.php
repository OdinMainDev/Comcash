<?php

namespace App\Telegram\Response;

use App\Http\Traits\Models\HasTelegramBot;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Response\Callbackquery\Router;
use Longman\TelegramBot\Request;

class CallbackqueryCommand extends SystemCommand
{
    use HasTelegramBot, BotFunctions;

    protected $name = 'callbackquery';
    protected $description = 'Handle the callback query';
    protected $version = '1.2.0';

    public function execute(): ServerResponse
    {
        $callback_query = $this->getCallbackQuery();
        $user = $this->getUserBotModel($callback_query->getFrom(), $this->constructBotData());
        $response = new Router($callback_query, $user);
        $response->exec();

        return Request::emptyResponse();
    }
}