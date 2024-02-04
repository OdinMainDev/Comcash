<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasTelegramBot;
use Illuminate\Http\Request;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;

class Controller_TelegramBot extends Controller{

    use HasTelegramBot;

    public function process(Request $request, $id) {
        if (!is_numeric($id))
            return abort(404);
        
        $bot = $this->getTelegramBotModel($id);
        if (!$bot)
            return abort(404);

        try {
            $telegram = new Telegram($bot->token, $bot->username);
            $telegram_id = $telegram->getBotId();
            if (!$bot->telegram_id || $bot->telegram_id != $telegram_id) {
                $bot->telegram_id = $telegram_id;
                $bot->save();
            }

            $telegram->setCustomInput(json_encode($request->all()));
            $telegram->addCommandsPaths([
                app_path() . '/Telegram/Response/'
            ]);

            $telegram->handle();

        } catch (TelegramException $e) {
            
            sendTelegramNotification("ОШИБКА ТЕЛЕГРАМ БОТА\n".$e->getMessage());
            $this->responseErrorValidation(["undefined" => $e->getMessage()]);
        }
        return;
    }
}
