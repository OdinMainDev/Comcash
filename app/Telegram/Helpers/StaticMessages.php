<?php
     
namespace App\Telegram\Helpers;

use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

trait StaticMessages {
    use Keyboards;

    public function sendMainMenu($chat_id, $language){
        $buttons = [];
        $buttons[] = [
            __("telegram.bottom_menu_1", [], $language), // новый обмен
        ];
        $buttons[] = [
            __("telegram.bottom_menu_2", [], $language), // о боте
            __("telegram.bottom_menu_3", [], $language), // личный кабинет
        ];

        $bottomButtons = [];
        $bottomButtons[] = __("telegram.bottom_menu_4", [], $language); // поддержка
        if(Config::get("app.telegram_use_main_menu_community")) {
            $bottomButtons[] = __("telegram.bottom_menu_5", [], $language); // сообщество
        }
        if(Config::get("app.telegram_use_main_menu_languages")) {
            $bottomButtons[] = __("telegram.profile_open_change_language", [], $language); // смена языка
        }

        $buttons[] = $bottomButtons;

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.welcome_message", [], $language),
            'reply_markup' => [
                "keyboard" => $buttons
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
            $text .= " @".$this->user->username;
            $text .= "\n";
        }
        $text .= __("telegram.profile_total_exchanges", [], $language);
        $text .= " ".$this->user->getUser->getCountExchanges();


        $headerButtonsAll = [];
        $headerButtons = [];
        $headerButtons[] = [
            "text" =>__("telegram.profile_open_exchanges_history", [], $language), 
            "callback_data" => "openExchangesHistory:;:1", 
        ];
        if(count(Config::get("app.languages")) > 1){
            $headerButtons[] = [
                "text" =>__("telegram.profile_open_change_language", [], $language), 
                "callback_data" => "openChangeLanguage:;:", 
            ];
        }
        $headerButtonsAll[] = $headerButtons;
        if(Config::get("app.telegram_use_affiliate")) {
            $headerButtonsAll[] = [
                [
                    "text" =>__("telegram.profile_open_affiliate", [], $language), 
                    "callback_data" => "openAffiliatePanel:;:", 
                ]
            ];
        }
        if(Config::get("app.telegram_use_website")) {
            $headerButtonsAll[] = [
                [
                    "text" =>__("telegram.profile_goto_web", [], $language), 
                    "callback_data" => "gotoWeb:;:", 
                ],
            ];
        }
        $headerButtonsAll[] = [
            [
                "text" =>__("telegram.back_to_main_menu", [], $language), 
                "callback_data" => "openMainMenu:;:", 
            ],
        ];
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => $headerButtonsAll
            ],
        ]);
    }

    public function sendAboutBotMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.about_menu", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendSupportBotMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.support_menu", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendCommunityBotMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.community_menu", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendUnknownActionMessage($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.unknown_action", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendCreateExchangeError($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.exchange_create_error", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendCreateExchangeSuccess($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.exchange_create_success", [], $language),
        ]);
    }

    public function sendLanguageMessage($chat_id, $language){
        $keyboard = KeyboardGenerator::generate($this->keyboardLanguages($language));
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.choose_language", [], $language),
            'reply_markup' => $keyboard,
        ]);
    }

    public function sendLanguageSetSuccess($chat_id, $language){
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.choose_language_success", [], $language),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_main_menu", [], $language), 
                            "callback_data" => "openMainMenu:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }
}