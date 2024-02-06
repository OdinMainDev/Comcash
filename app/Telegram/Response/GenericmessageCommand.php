<?php

namespace App\Telegram\Response;

use App\Http\Traits\Models\HasTelegramBot;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use App\Telegram\Helpers\BotFunctions;
use App\Telegram\Response\Message\Router;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    use HasTelegramBot, BotFunctions;

    protected $name = 'genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '1.2.0';

    protected $private_only = true;

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();
        $user = $this->getUserBotModel($message->getFrom(), $this->constructBotData());
        $response = new Router($message, $user);
        $response->exec();
        return Request::emptyResponse();
    }
}