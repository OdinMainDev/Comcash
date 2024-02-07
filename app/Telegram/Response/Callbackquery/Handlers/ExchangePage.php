<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use App\Http\Traits\Models\HasCache;
use App\Telegram\Helpers\KeyboardGenerator;
use Longman\TelegramBot\Request;

trait ExchangePage {
    use HasCache;

    public function openExchangePage($chat_id, $language){
        $currencies = $this->getCachedCurrencyDirectionsFrom();
        $keyboard = [];
        foreach($currencies as $currency){
            $keyboard[$currency->getTitle($language)] = $currency->id;
        }
        $keyboard = KeyboardGenerator::generate(KeyboardGenerator::makeFromKeyValueArray($keyboard, "openExchangePageStep2"));
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
            $rate = $this->estimateGetRate($currency->name, $currencyFrom->name);
            if(!$rate){
                continue;
            }
            
            if($rate < 0.01){
                $rate = $this->estimateGetRate($currencyFrom->name, $currency->name);
                $key .= " / 1 : ".$rate."";
            }else{
                $key .= " / ".$rate." : 1";
            }
            
            $newCurrencies[$key] = $currencyFrom->id."_".$currency->id;
        }
        $keyboard = KeyboardGenerator::generate(KeyboardGenerator::makeFromKeyValueArray($newCurrencies, "openExchangePageStep3"), 1);
        $keyboard['inline_keyboard'][] = [[
            "text" =>__("telegram.back_to_exchange_step_1", [], $language), 
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

    public function validateExchangeDirectionByCurrencies($data){
        $data = explode("_", $data);
        if(count($data) != 2)
            return false;

        if(!is_numeric($data[0]) || !is_numeric($data[1]))
            return false;

        $currencyFrom = $this->getCacheDirections()->reject(function($currency) use($data){
            return $currency->id != $data[0];
        })->first();
        $currencyTo = $this->getCacheDirections()->reject(function($currency) use($data){
            return $currency->id != $data[1];
        })->first();
        if(!$currencyFrom || !$currencyTo)
            return false;

        $direction = $this->getDirectionByCurrencyPair($currencyFrom, $currencyTo);
        if(!$direction)
            return false;

        return $direction->id;
    }

    public function openExchangePage3($chat_id, $language, $directionId){
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(!$direction){
            return;
        }

        $this->user->action = config("app.telegram_actions")['exchangeSumFrom'];
        $this->user->action_data = $directionId;
        $this->user->save();

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $this->constructTextForExchangePage3($language, $direction),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.exchange_page_set_amount_in_currency", [], $language)." ".$direction->currencyTo->getTitle($language), 
                            "callback_data" => "exchangePageSetAmountInCurrencyTo:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_exchange_step_2", [], $language), 
                            "callback_data" => "openExchangePageStep2:;:".$direction->currency_from, 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function constructTextForExchangePage3($language, $direction, $isReverse = false){
        $text = __("telegram.exchange_page_set_amount_1", [], $language);
        $text .= "\n";
        $text .= __("telegram.exchange_page_set_amount_2", [], $language);
        $text .= " <b>".$direction->data['min_amount'];
        $text .= " ".$direction->currencyFrom->getTitle($language);
        $minAmountInToCurrency = $this->estimateAmount(
            $direction->currencyFrom->name, 
            $direction->currencyTo->name, 
            $direction->currencyTo->units, 
            $direction->data['min_amount'], 
            $direction->profit_percent, 
            false
        );
        $text .= " (~ ".$minAmountInToCurrency;
        $text .= " ".$direction->currencyTo->getTitle($language);
        $text .= ")</b>";
        $text .= " ".__("telegram.exchange_page_set_amount_3", [], $language);
        $text .= " <b>".$direction->data['max_amount'];
        $text .= " ".$direction->currencyFrom->getTitle($language);
        $maxAmountInToCurrency = $this->estimateAmount(
            $direction->currencyFrom->name, 
            $direction->currencyTo->name, 
            $direction->currencyTo->units, 
            $direction->data['max_amount'], 
            $direction->profit_percent, 
            false
        );
        $text .= " (~ ".$maxAmountInToCurrency;
        $text .= " ".$direction->currencyTo->getTitle($language);
        $text .= ")</b>";
        $text .= "\n";
        $text .= __("telegram.exchange_page_set_amount_4", [], $language);
        if(!$isReverse)
            $text .= " ".$direction->currencyFrom->getTitle($language);
        else
            $text .= " ".$direction->currencyTo->getTitle($language);
        return $text;
    }

    public function openExchangePage3Reverse($chat_id, $language, $directionId){
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(!$direction){
            return;
        }

        $this->user->action = config("app.telegram_actions")['exchangeSumTo'];
        $this->user->action_data = $directionId;
        $this->user->save();
        
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => $this->constructTextForExchangePage3($language, $direction, true),
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.exchange_page_set_amount_in_currency", [], $language)." ".$direction->currencyFrom->getTitle($language), 
                            "callback_data" => "exchangePageSetAmountInCurrencyFrom:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.back_to_exchange_step_2", [], $language), 
                            "callback_data" => "openExchangePageStep2:;:".$direction->currency_from, 
                        ],
                    ],
                ]
            ],
        ]);
    }

    public function checkCanOpenSetFieldsExchangeStep() {
        $data = $this->user->action_data;
        $data = explode("_", $data);
        $directionId = $data[0];
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(count($data) < 2 || !$directionId) {
            
            return false;
        }
        $amount = $data[1];
        $this->user->action = config("app.telegram_actions")["exchangeSetFields"];
        $this->user->action_data = $directionId."_".$amount;
        $this->user->save();
        
        return true;
    }
}