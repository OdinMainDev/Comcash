<?php
     
namespace App\Telegram\Helpers;

use Illuminate\Support\Facades\Config;
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

    public function sendRulesMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.rules", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.decline_rules", [], $language), 
                            "callback_data" => "setRules:;:false", 
                        ],
                        [
                            "text" =>__("telegram.accept_rules", [], $language), 
                            "callback_data" => "setRules:;:true", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendDeclineRulesMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.rules_must_be_accepted", [], $language),
        ]);
    }

    public function sendProfileMessage($chat_id, $language){
        $text = "";
        $text .= __("telegram.profile_hello", [], $language);
        $text .= " ".$this->user->first_name." ".$this->user->last_name;
        $text .= "\n\n";
        $text .= __("telegram.profile_id", [], $language);
        $text .= " ".$this->user->telegram_id;
        $text .= "\n";
        if($this->user->username && $this->user->username != ""){
            $text .= __("telegram.profile_username", [], $language);
            $text .= " ".$this->user->username;
            $text .= "\n";
        }
        $text .= __("telegram.profile_total_exchanges", [], $language);
        $text .= " ".$this->user->getUser->getCountExchanges();

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.profile_open_exchanges_history", [], $language), 
                            "callback_data" => "openExchangesHistory:;:1", 
                        ],
                        (count(Config::get("app.languages")) > 1 ? 
                        [
                            "text" =>__("telegram.profile_open_change_language", [], $language), 
                            "callback_data" => "openChangeLanguage:;:", 
                        ]
                        : null)
                    ],
                    [
                        [
                            "text" =>__("telegram.profile_open_affiliate", [], $language), 
                            "callback_data" => "openAffiliatePanel:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "backToMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    // public function sendLanguageMessage($chat_id, $language){
    //     Request::sendMessage([
    //         'chat_id' => $chat_id,
    //         'parse_mode' => 'html',
    //         'text' => __("telegram.rules", [], $language),
    //         'reply_markup' => [
    //             "inline_keyboard" => [
    //                 [
    //                     [
    //                         "text" =>__("telegram.decline_rules", [], $language), 
    //                         "callback_data" => "setRules:;:false", 
    //                     ],
    //                     [
    //                         "text" =>__("telegram.accept_rules", [], $language), 
    //                         "callback_data" => "setRules:;:true", 
    //                     ],
    //                 ],
    //             ]
    //         ],
    //     ]);
    // }
}