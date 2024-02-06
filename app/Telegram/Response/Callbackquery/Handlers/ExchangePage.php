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
        $keyboard = KeyboardGenerator::generate(KeyboardGenerator::makeFromKeyValueArray($newCurrencies, "openExchangePageStep2"));
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_main_menu", [], $language), 
            "callback_data" => "openMainMenu:;:", 
        ]];
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  __("telegram.exchange_page_choose_currency_from", [], $language),
            'reply_markup' => $keyboard,
        ]);
    }

    public function validateCurrencyFrom($id){
        if(!is_numeric($id))
            return false;

        $ids = $this->getCacheDirections()->pluck("currency_from")->toArray();
        if(!in_array($id, $ids))
            return false;

        return true;
    }

    public function openExchangePage2($chat_id, $language, $id){
        $currencyFrom = $this->getCacheCurrencies()->reject(function ($currency) use($id) {
            return $currency->id != $id;
        })->first();
        $currencies = $this->getCachedCurrencyDirectionsTo($id);
        $newCurrencies = [];
        foreach($currencies as $currency){
            $key = $currency->getTitle($language);
            $key .= " / ".$this->estimateGetRate($currencyFrom->name, $currency->name)." : 1";
            $newCurrencies[$key] = $currency->id;
        }
        $keyboard = KeyboardGenerator::generate(KeyboardGenerator::makeFromKeyValueArray($newCurrencies, "openExchangePageStep3"), 1);
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_main_menu", [], $language), 
            "callback_data" => "openExchangePageStep1:;:", 
        ]];

        $text = __("telegram.exchange_page_choose_currency_to1", [], $language);
        $text .= " ".$currencyFrom->getTitle($language);
        $text .= "\n";
        $text .= __("telegram.exchange_page_choose_currency_to2", [], $language);

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text,
            'reply_markup' => $keyboard,
        ]);
    }
}