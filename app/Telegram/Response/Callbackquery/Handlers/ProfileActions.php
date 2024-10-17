<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasAffiliate;
use App\Http\Traits\Models\HasCache;
use App\Models\AffiliateBalance;
use App\Models\AffiliateExchange;
use App\Models\AffiliateWithdraw;
use App\Models\Currency;
use App\Models\Exchange;
use App\Telegram\Helpers\KeyboardGenerator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Longman\TelegramBot\Request;

trait ProfileActions {
    use HasCache, HasTelegramMessage, HasAffiliate;
    
    public function profileGoToWeb($chat_id, $language, $exchanger_user_id){
        $hash = [
            "created_at" => time(),
            "id" => $this->user->getUser->id,
            "hash" => hash("sha256", $this->user->getUser->id."VISALT221asd127685".$this->user->getUser->email),
        ];
        $hash = Crypt::encrypt($hash);
        $text = __("telegram.your_personal_link", [], $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.goto_web_text", [], $language), 
                            "url" => route("loginApiUrl", ["hash" => $hash]),
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_profile", [], $language), 
                            "callback_data" => "openProfile:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendUserExchangesHistory($chat_id, $language, $page_number) {
        if(!is_numeric($page_number) || $page_number < 1){
            $page_number = 1;
        }
        $totalExchanges = $this->user->getUser->getCountExchanges();
        $text = "<b>".__("telegram.exchanges_history_title", [], $language)."</b>\n";
        $text .= __("telegram.exchanges_history_description", [], $language)."\n\n";
        $text .= "<b>".__("telegram.profile_total_exchanges", [], $language)."</b>";
        $text .= " ".$totalExchanges."\n";
        $exchanges = $this->getCacheExchanges($this->user->user_id, $page_number);
        if($totalExchanges > 0){
            // $text .= __("telegram.profile_current_paginate_exchanges", [], $language);
            // $currentRealIndex = (10 * ($page_number - 1));
            // $text .= " ".($currentRealIndex + 1)."->".($currentRealIndex + 11 > $totalExchanges ? $totalExchanges : $currentRealIndex + 11)."/".$totalExchanges;
            $keyboardArray = [];
            foreach($exchanges as $index => $exchange){
                $key = (string)(($exchange->id)).": ".$exchange->currencyFrom->getTitle($language)." -> ".$exchange->currencyTo->getTitle($language);
                $keyboardArray[$key] = $exchange->id."_".$page_number;
            }
            $keyboard = KeyboardGenerator::generate(
                KeyboardGenerator::makeFromKeyValueArray($keyboardArray, "openExchangeHistoryById"), 1,
                $totalExchanges > 10 ? KeyboardGenerator::makePaginationData("openExchangesHistory", $page_number, $totalExchanges) : [],
            );
        }else{
            $keyboard = [];
            $keyboard['inline_keyboard'] = [];
        }

        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_profile", [], $language), 
            "callback_data" => "openProfile:;:",
        ]];
        $postData = [
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => $keyboard
        ];
        Request::sendMessage($postData);
    }

    public function sendUserExchangeHistory($chat_id, $language, $data) {
        $data = explode("_", $data);
        if(count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])){
            return;
        }
        $exchange = Exchange::where("id", $data[0])->where("user_id", $this->user->user_id)->where("status", 5)->first();
        if(!$exchange){
            return;
        }
        $text = $this->tgUserExchangeStartMessage($exchange, $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_exchanges_history", [], $language), 
                            "callback_data" => "openExchangesHistory:;:".$data[1], 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendUserAffiliatePanelMessage($chat_id, $language) {
        $campaign = $this->getTelegramUserCampaign($this->user->getUser);
        $text = __("telegram.my_affiliate_exchanges_title", [], $language);
        $text .= "\n\n";
        $text .= __("telegram.my_affiliate_exchanges_registered_users", [], $language);
        $text .= " ".$campaign->registered_users."\n";
        $text .= __("telegram.my_affiliate_exchanges_profitable_transactions", [], $language);
        $text .= " ".$campaign->profitable_transactions."\n";
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.my_affiliate_url", [], $language), 
                            "callback_data" => "sendAffiliateUrl:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.my_affiliate_balances", [], $language), 
                            "callback_data" => "openAffiliateBalances:;:", 
                        ],
                        [
                            "text" =>__("telegram.my_affiliate_withdraws", [], $language), 
                            "callback_data" => "openAffiliateWithdraws:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.my_affiliate_exchanges", [], $language), 
                            "callback_data" => "openAffiliateExchanges:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_profile", [], $language), 
                            "callback_data" => "openProfile:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendUserAffiliateUrlMessage($chat_id) {
        $campaign = $this->getTelegramUserCampaign($this->user->getUser);
        $text = "https://t.me/".$this->bot->username."?start=".$campaign->hash;
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
        ]);
    }

    public function sendUserAffiliateBalancePanelMessage($chat_id, $language) {
        $text = __("telegram.my_affiliate_balances_title", [], $language);
        $text .= "\n\n";
        $text .= __("telegram.my_affiliate_balances_text", [], $language);
        $text .= "\n\n";
        $balances = $this->getCacheAffiliatesBalances($this->user->user_id);
        foreach($balances as $balance){
            $text .= "<b>".$balance->getCurrency->getTitle($language).":</b> ".$balance->balance."\n";
        }
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.my_affiliate_url", [], $language), 
                            "callback_data" => "sendAffiliateUrl:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.do_affiliate_withdraw", [], $language), 
                            "callback_data" => "openCreateAffiliateWithdraw:;:", 
                        ],
                        [
                            "text" =>__("telegram.my_affiliate_withdraws", [], $language), 
                            "callback_data" => "openAffiliateWithdraws:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.my_affiliate_exchanges", [], $language), 
                            "callback_data" => "openAffiliateExchanges:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_profile", [], $language), 
                            "callback_data" => "openProfile:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendCreateAffiliateWithdrawMessage($chat_id, $language) {
        $text = __("telegram.my_affiliate_balance_withraw_title", [], $language);
        $text .= "\n\n";
        $text .= __("telegram.my_affiliate_balance_withraw_text", [], $language);
        $balances = $this->getCacheAffiliatesBalances($this->user->user_id);
        $keyboards = [];
        foreach($balances as $balance){
            $keyboards[] = [
                [
                    "text" => $balance->getCurrency->getTitle($language).": ".$balance->balance, 
                    "callback_data" => "doCreateAffiliateWithdraw:;:".$balance->currency, 
                ],
            ];
        }
        $keyboards[] = [
            [
                "text" =>__("telegram.back_to_affiliate_panel", [], $language), 
                "callback_data" => "openAffiliatePanel:;:", 
            ]
        ];
        $keyboards[] = [
            [
                "text" =>__("telegram.back_to_profile", [], $language), 
                "callback_data" => "openProfile:;:", 
            ]
        ];
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => $keyboards
            ],
        ]);
    }

    public function openDoCreateAffiliateWithdrawPage($chat_id, $language, $currencyId) {
        $balance = AffiliateBalance::where("currency", $currencyId)->where("user_id", $this->user->user_id)->first();
        if(!$balance){
            return;
        }

        $this->user->action = config("app.telegram_actions")['affiliateCreateWithdrawSetAmount'];
        $this->user->action_data = $balance->id;
        $this->user->save();
        $text = __("telegram.aff_withdraw_set_amount", [], $language);
        $text .= $balance->getCurrency->getTitle($language).": ".$balance->balance."\n";
        $text = __("telegram.aff_withdraw_set_amount_2", [], $language);
        $keyboards = [];
        
        $keyboards[] = [
            [
                "text" =>__("telegram.back_to_affiliate_balances_panel", [], $language), 
                "callback_data" => "openCreateAffiliateWithdraw:;:", 
            ]
        ];
        $keyboards[] = [
            [
                "text" =>__("telegram.back_to_affiliate_panel", [], $language), 
                "callback_data" => "openAffiliatePanel:;:", 
            ]
        ];

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text,
            'reply_markup' => [
                "inline_keyboard" => $keyboards
            ],
        ]);
    }

    public function sendAffiliateWithdrawsHistory($chat_id, $language, $page_number) {
        if(!is_numeric($page_number) || $page_number < 1){
            $page_number = 1;
        }
        $withdraws = $this->getCacheAffiliatesWithdraws($this->user->user_id, $page_number);
        $totalWithdraws = $this->user->getUser->getCountAllWithdraws();
        $text = "<b>".__("telegram.withdraws_history_title", [], $language)."</b>\n";
        $text .= __("telegram.withdraws_history_description", [], $language)."\n\n";
        $text .= "<b>".__("telegram.profile_total_withdraws", [], $language)."</b>";
        $text .= " ".$totalWithdraws."\n";
        $keyboardArray = [];
        if($totalWithdraws > 0){
            $text .= __("telegram.profile_current_paginate_withdraws", [], $language);
            $currentRealIndex = (10 * ($page_number - 1));
            $text .= " ".($currentRealIndex + 1)." ";
            $text .= __("telegram.profile_current_paginate_withdraws_2", [], $language);
            $text .= " ".($currentRealIndex + 11 > $totalWithdraws ? $totalWithdraws : $currentRealIndex + 11)."/".$totalWithdraws." ";
            $text .= __("telegram.profile_current_paginate_withdraws_3", [], $language);
            foreach($withdraws as $index => $withdraw){
                $key = (string)(($withdraw->id)).": ".$withdraw->getCurrency->getTitle().": ".$withdraw->amount;
                $keyboardArray[$key] = $withdraw->id."_".$page_number;
            }
            $keyboard = KeyboardGenerator::generate(
                KeyboardGenerator::makeFromKeyValueArray($keyboardArray, "openWithdrawHistoryById"), 1,
                $totalWithdraws > 10 ? KeyboardGenerator::makePaginationData("openAffiliateWithdraws", $page_number, $totalWithdraws) : [],
            );
        }else{
            $keyboard = [];
            $keyboard['inline_keyboard'] = [];
        }

        $keyboard['inline_keyboard'][] = [
            [
                "text" =>__("telegram.my_affiliate_balances", [], $language), 
                "callback_data" => "openAffiliateBalances:;:", 
            ],
            [
                "text" =>__("telegram.do_affiliate_withdraw", [], $language), 
                "callback_data" => "openCreateAffiliateWithdraw:;:", 
            ],
        ];
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.my_affiliate_exchanges", [], $language), 
            "callback_data" => "openAffiliateExchanges:;:", 
        ]];
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_profile", [], $language), 
            "callback_data" => "openProfile:;:",
        ]];
        $postData = [
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => $keyboard
        ];
        Request::sendMessage($postData);
    }

    public function sendAffiliateWithdrawHistory($chat_id, $language, $data) {
        $data = explode("_", $data);
        if(count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])){
            return;
        }
        $withdraw = AffiliateWithdraw::where("id", $data[0])->where("user_id", $this->user->user_id)->first();
        if(!$withdraw){
            return;
        }
        $text = $this->tgUserWithdrawStatusMessage($withdraw, $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_withdraws_history", [], $language), 
                            "callback_data" => "openAffiliateWithdraws:;:".$data[1], 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function sendAffiliateExchangesHistory($chat_id, $language, $page_number) {
        if(!is_numeric($page_number) || $page_number < 1){
            $page_number = 1;
        }
        $exchanges = $this->getCacheAffiliatesExchanges($this->user->user_id, $page_number);
        $totalExchanges = $this->user->getUser->getCountAllAffiliateExchanges();
        $text = "<b>".__("telegram.aff_exchanges_history_title", [], $language)."</b>\n";
        $text .= __("telegram.aff_exchanges_history_description", [], $language)."\n\n";
        $text .= "<b>".__("telegram.profile_aff_total_exchanges", [], $language)."</b>";
        $text .= " ".$totalExchanges."\n";
        $keyboardArray = [];
        if($totalExchanges > 0){
            $text .= __("telegram.profile_current_paginate_aff_exchanges", [], $language);
            $currentRealIndex = (10 * ($page_number - 1));
            $text .= " ".($currentRealIndex + 1)." ";
            $text .= __("telegram.profile_current_paginate_aff_exchanges_2", [], $language);
            $text .= " ".($currentRealIndex + 11 > $totalExchanges ? $totalExchanges : $currentRealIndex + 11)."/".$totalExchanges." ";
            $text .= __("telegram.profile_current_paginate_aff_exchanges_3", [], $language);
            foreach($exchanges as $index => $exchange){
                $key = (string)(($exchange->id)).": ".$exchange->getCurrency->name.": ".$exchange->amount." (".$exchange->amount_earned.")";
                $keyboardArray[$key] = $exchange->id."_".$page_number;
            }
            $keyboard = KeyboardGenerator::generate(
                KeyboardGenerator::makeFromKeyValueArray($keyboardArray, "openAffiliateExchangeById"), 1,
                $totalExchanges > 10 ? KeyboardGenerator::makePaginationData("openAffiliateExchanges", $page_number, $totalExchanges) : [],
            );
        }else{
            $keyboard = [];
            $keyboard['inline_keyboard'] = [];
        }

        $keyboard['inline_keyboard'][] = [
            [
                "text" =>__("telegram.my_affiliate_balances", [], $language), 
                "callback_data" => "openAffiliateBalances:;:", 
            ],
            [
                "text" =>__("telegram.my_affiliate_withdraws", [], $language), 
                "callback_data" => "openAffiliateWithdraws:;:", 
            ],
        ];
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.do_affiliate_withdraw", [], $language), 
            "callback_data" => "openCreateAffiliateWithdraw:;:", 
        ],];
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_profile", [], $language), 
            "callback_data" => "openProfile:;:",
        ]];
        $postData = [
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => $keyboard
        ];
        Request::sendMessage($postData);
    }

    public function sendAffiliateExchangeHistory($chat_id, $language, $data) {
        $data = explode("_", $data);
        if(count($data) != 2 || !is_numeric($data[0]) || !is_numeric($data[1])){
            return;
        }
        // $campaign = $this->getTelegramUserCampaign($this->user->getUser);
        $exchange = AffiliateExchange::where("id", $data[0])->where("user_id", $this->user->user_id)->first();
        if(!$exchange){
            return;
        }
        $text = $this->tgUserExchangeStatusMessage($exchange, $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.back_to_exchanges_history", [], $language), 
                            "callback_data" => "openAffiliateExchanges:;:".$data[1], 
                        ],
                    ],
                ]
            ],
        ]);
    }
}