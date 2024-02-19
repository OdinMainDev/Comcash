<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use App\Http\Traits\Models\HasCache;
use App\Telegram\Helpers\KeyboardGenerator;
use Illuminate\Support\Facades\Config;
use Longman\TelegramBot\Request;

trait ProfileActions {
    use HasCache;
    
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
        $text .= "<b>".__("telegram.profile_total_exchanges", [], $language).":</b>";
        $text .= " ".$totalExchanges."\n";
        $exchanges = $this->getCacheExchanges($this->user->user_id, $page_number);
        $keyboardArray = [];
        foreach($exchanges as $index => $exchange){
            $key = (string)($index + 1).": ".$exchange->currencyFrom->name." -> ".$exchange->currencyTo->name;
            $keyboardArray[$key] = $exchange->id;
        }
        $keyboard = KeyboardGenerator::generate(
            KeyboardGenerator::makeFromKeyValueArray($keyboardArray, "openExchangeHistoryById"), 1,
            KeyboardGenerator::makePaginationData("openExchangesHistory", $page_number, $totalExchanges)
        );
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $text,
            'reply_markup' => $keyboard,
        ]);
    }
}