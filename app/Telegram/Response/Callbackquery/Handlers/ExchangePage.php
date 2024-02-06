<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use App\Http\Traits\Models\HasCache;
use App\Telegram\Helpers\KeyboardGenerator;
use Longman\TelegramBot\Request;

trait ExchangePage {
    use HasCache;

    public function openExchangePage($chat_id, $language){
        $currencies = $this->getCachedCurrencyDirectionsFrom();
        $newCurrencies = [];
        foreach($currencies as $currency){
            $newCurrencies[$currency->getTitle($language)] = $currency->id;
        }
        $keyboard = KeyboardGenerator::generate(KeyboardGenerator::makeFromKeyValueArray($newCurrencies, "exchangePageStep2"));
        $keyboard['inline_keyboard'][] = [
            "text" =>__("telegram.back_to_main_menu", [], $language), 
            "callback_data" => "openProfile:;:", 
        ];
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  __("telegram.exchange_page_choose_currency_from", [], $language),
            'reply_markup' => $keyboard,
        ]);
    }
}