<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

trait ProfileActions {

    public function profileGoToWeb($chat_id, $language, $exchanger_user_id){
        $text = __("telegram.goto_web_text", [], $language);
        $text .= " ".route("index");
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openProfile:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }
}