<?php
     
namespace App\Telegram\Helpers;

use Longman\TelegramBot\Request;

trait StaticMessages {

    public function sendMainMenu($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.welcome_message", [], $language),
            'reply_markup' => [
                "keyboard" => [
                    [
                        "text" => __("telegram.bottom_menu_1", [], $language), // новый обмен
                    ],
                    [
                        "text" => __("telegram.bottom_menu_2", [], $language), // о боте
                        "text" => __("telegram.bottom_menu_3", [], $language), // личный кабинет
                    ],
                    [
                        "text" => __("telegram.bottom_menu_4", [], $language), // поддержка
                        "text" => __("telegram.bottom_menu_5", [], $language), // сообщество
                    ],
                ]
            ],
        ]);
    }
}