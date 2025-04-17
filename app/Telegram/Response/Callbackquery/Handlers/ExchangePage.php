<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasCache;
use App\Jobs\ExchangeStart;
use App\Models\Exchange;
use App\Telegram\Helpers\KeyboardGenerator;
use Longman\TelegramBot\Request;

trait ExchangePage {
    use HasCache, HasTelegramMessage;

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
        $directions = $this->getCachedDirectionsTo($id);
        $newCurrencies = [];
        // $currencyToExist = [];
        foreach($directions as $direction){
            // if(in_array($direction->currency_to, $currencyToExist)){
            //     continue;
            // }
            // $currencyToExist[] = $direction->currency_to;
            $currency = $direction->currencyTo;
            $key = $currency->getTitle($language);
            $rate = $this->estimateGetRate($currency->name, $currencyFrom->name, $direction->profit_percent);
            if(!$rate){
                continue;
            }
            
            if($rate < 0.01){
                $rate = $this->estimateGetRate($currencyFrom->name, $currency->name, $direction->profit_percent);
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

        $currencyFrom = $this->getCacheCurrencies()->reject(function($currency) use($data){
            return $currency->id != $data[0];
        })->first();
        $currencyTo = $this->getCacheCurrencies()->reject(function($currency) use($data){
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
        $text .= " (</b>~ <b>".$minAmountInToCurrency;
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
        if(count($data) < 2 || !$directionId || !$direction) {
            return false;
        }

        $amount = $data[1];
        $this->user->action = config("app.telegram_actions")["exchangeSetFields"];
        $this->user->action_data = $directionId."_".$amount;
        $this->user->save();
        
        return true;
    }
    
    public function checkCanCreateExchange() {
        $data = $this->user->action_data;
        $data = explode("_", $data);
        if(count($data) <= 3) {
            return false;
        }
        // $amountFrom = 0;
        // $amountTo = 0;
        $directionId = $data[0];
        $finalAmount = $data[1];
        $isReverse = $data[2];
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(!$directionId) {
            return false;
        }
        $fields = $direction->getLayoutTelegramAttribute();
        if(count($data) - 3 != count($fields)){
            return false;
        }
        $requestData = [];
        foreach($data as $key => $value) {
            if($key == 0){
                continue;
            }
            if($key == 1){
                $finalAmount = $value;
                continue;
            }
            if($key == 2){
                $isReverse = $value == "true";
                continue;
            }
            foreach($fields as $key2 => $field){
                if($key - 3 == $key2){
                    $requestData[$field] = $value;
                }
            }
        }
        $units = $direction->currencyTo->units;
        $amountFrom = $finalAmount;
        $currencyFrom = $direction->currencyFrom->name;
        $currencyTo = $direction->currencyTo->name;
        if($isReverse) {
            $units = $direction->currencyFrom->units;
            $currencyFrom = $direction->currencyTo->name;
            $currencyTo = $direction->currencyFrom->name;
            $amountFrom = 0;
            $amountTo = $finalAmount;
        }

        if (!$isReverse) {
            $amountTo = $this->estimateAmount($currencyFrom, $currencyTo, $units, $amountFrom, $direction->profit_percent);
        } else {
            $amountFrom = $this->estimateAmount($currencyFrom, $currencyTo, $units, $amountTo, $direction->profit_percent);
        }

        if(!$amountTo) {
            return false;
        }
        $exchange = new Exchange;
        $exchange->hash = hash("sha256", uniqid().time()."cmcshsaltbyvio");
        $exchange->direction_id = $direction->id;
        $exchange->currency_from = $direction->currency_from;
        $exchange->currency_to = $direction->currency_to;
        $exchange->merchant_from = $direction->merchant_from;
        $exchange->merchant_to = $direction->merchant_to;
        $exchange->merchant_type_from = $direction->merchant_type_from;
        $exchange->merchant_type_to = $direction->merchant_type_to;
        $exchange->data = [
            "request_data" => $requestData,
            "device_data" => [
                "ip" => "127.0.0.1",
                "user_agent" => "telegram",
                "language" => $this->user->language,
                "fid" => "",
            ],
            "amount_data" => [
                "amount_send" => $amountFrom,
                "amount_send_usd" => $this->estimateAmount($direction->currencyFrom->name, "USD", 2, $amountFrom, $direction->profit_percent),
                "amount_receive" => $amountTo,
                "amount_receive_usd" => $this->estimateAmount($direction->currencyTo->name, "USD", 2, $amountFrom, 0),
                "exchange_rate" => $this->estimateGetRate($direction->currencyFrom->name, $direction->currencyTo->name),
                "exchange_rate_to_usd" => $this->estimateGetRate($direction->currencyFrom->name, "USD"),
                "currency_from_name" => $this->convertCurrencyName($direction->currencyFrom->name),
                "currency_to_name" => $this->convertCurrencyName($direction->currencyTo->name)
            ],
            "recalculate" => [
                "has_recalculation" => false
            ],
            "isTelegramExchange" => true
        ];
        
        $exchange->save();
        ExchangeStart::dispatch($exchange->id, $this->user->language, $this->user->getUser);
        
        return true;
    }

    public function checkIPaidButtonAndResponse($chat_id, $language, $id) {
        if(!is_numeric($id))
            return;
        
        $exchange = Exchange::where("status", 0)->where("id", $id)->where("user_id", $this->user->user_id)->first();
        if(!$exchange)
            return;

        $exchange->status = 1;
        $exchange->created_at = now();
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ОПЛАЧЕНА ПОЛЬЗОВАТЕЛЕМ</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' => __("telegram.i_paid_message", [], $language),
        ]);
    }
}