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
                        __("telegram.bottom_menu_1", [], $language), // новый обмен
                    ],
                    [
                       __("telegram.bottom_menu_2", [], $language), // о боте
                       __("telegram.bottom_menu_3", [], $language), // личный кабинет
                    ],
                    [
                        __("telegram.bottom_menu_4", [], $language), // поддержка
                        __("telegram.bottom_menu_5", [], $language), // сообщество
                    ],
                ]
            ],
        ]);
    }
}