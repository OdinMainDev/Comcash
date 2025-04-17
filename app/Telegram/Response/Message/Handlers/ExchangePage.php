<?php
     
namespace App\Telegram\Response\Message\Handlers;

use App\Http\Traits\Models\HasCache;
use Longman\TelegramBot\Request;

trait ExchangePage {
    use HasCache;

    public function exchangeSetAmount($chat_id, $language, $textAmount){
        if(!is_numeric($textAmount)){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language);
        }
        $directionId = $this->user->action_data;
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(!$direction){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_2");
        }
        $isReverse = $this->user->action == config("app.telegram_actions")['exchangeSumTo'];
        $units = $direction->currencyTo->units;
        $currencyFrom = $direction->currencyFrom->name;
        $currencyTo = $direction->currencyTo->name;
        if($isReverse){
            $units = $direction->currencyFrom->units;
            $currencyFrom = $direction->currencyTo->name;
            $currencyTo = $direction->currencyFrom->name;
        }

        $amount = $this->estimateAmount($currencyFrom, $currencyTo, $units, $textAmount, $direction->profit_percent);
        if(!$amount) {
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_3");
        }

        $checkAmount = $isReverse ? $amount : $textAmount;
        if(!$checkAmount) {
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_666");
        }

        if(!@$direction->data['min_amount'] || $direction->data['min_amount'] > $checkAmount){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_4");
        }
        if(!@$direction->data['max_amount'] || $direction->data['max_amount'] < $checkAmount){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_5");
        }
        
        $isReverse = $isReverse ? 'true' : 'false';
        $this->user->action = config("app.telegram_actions")["exchangeSetFields"];
        $this->user->action_data = $directionId."_".$checkAmount."_".$isReverse;
        $this->user->save();
        $this->exchangeFieldMessage($chat_id, $language, 0, $direction);
    }

    public function exchangeSetAmountErrorMessage($chat_id, $language, $message = "exchange_create_error_1", $additional_data = "") {
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  __("telegram.".$message, [], $language)." ".$additional_data,
        ]);
    }

    public function exchangeFieldMessage($chat_id, $language, $fieldIndex = 0, $direction = false) {
        if(!$direction){
            $directionId = $this->user->action_data;
            $directionId = explode("_", $directionId)[0];
            $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
                return $row->id != $directionId;
            })->first();
            if(!$direction){
                return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_2");
            }
        }
        $field = $direction->getLayoutTelegramAttribute()[$fieldIndex];

        $text = __("telegram.exchange_set_field", [], $language);
        $text .= "\n";
        $text = __("telegram.exchange_set_field_".$field, [], $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text,
        ]);
    }

    public function exchangeSetField($chat_id, $language, $text){
        $data = $this->user->action_data;
        $data = explode("_", $data);
        $data[] = $text;
        $directionId = $data[0];
        $direction = $this->getCacheDirections()->reject(function ($row) use($directionId) {
            return $row->id != $directionId;
        })->first();
        if(!$direction){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_2");
        }
        $fields = $direction->getLayoutTelegramAttribute();
        $this->user->action_data = $this->user->action_data."_".$text;
        
        // вычитаем 2 так как есть directionid_amount
        if(count($data) - 3 < count($fields)){
            $fieldIndex = count($data) - 3;
            $this->exchangeFieldMessage($chat_id, $language, $fieldIndex, $direction);
            $this->user->save();
            return;
        }

        // TODO: раскоментить
        // $this->user->action = 0;
        // $this->user->save();


        // это последний заполненный филд
        // выдаем сообщение подтверждения

        $text = __("telegram.exchange_check_1", [], $language);
        $text .= "\n\n";

        $finalAmount = 0;
        $amountFrom = 0;
        $amountTo = 0;
        $isReverse = false;
        $appendText = "";
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
                    $appendText .= __("telegram.exchange_check_field_".$field, [], $language);
                    $appendText .= " <b>".$value."</b>";
                    $appendText .= "\n";
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
            $amountTo = $this->estimateAmount($currencyFrom, $currencyTo, $units, $finalAmount, $direction->profit_percent);
        } else {
            $amountFrom = $this->estimateAmount($currencyFrom, $currencyTo, $units, $finalAmount, $direction->profit_percent);
        }

        return $this->exchangeSetAmountErrorMessage($chat_id, $language, $units." ".$amountFrom." ".$amountTo);
        $amountTo = $this->estimateAmount($direction->currencyFrom->name, $direction->currencyTo->name, $units, $amountFrom, $direction->profit_percent, $isReverse);
        if(!$amountTo) {
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_check_error_1");
        }

        if(!@$direction->data['min_amount'] || $direction->data['min_amount'] > $amountFrom){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_check_error_2");
        }
        if(!@$direction->data['max_amount'] || $direction->data['max_amount'] < $amountFrom){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_check_error_3");
        }

        
        $text .= __("telegram.exchange_check_2", [], $language);
        $text .= " <b>".$direction->currencyFrom->getTitle($language)." -> ".$direction->currencyTo->getTitle($language)."</b>";
        $text .= "\n";
        $text .= __("telegram.exchange_check_3", [], $language);
        $text .= " <b>".$amountFrom." ".$direction->currencyFrom->getTitle($language)."</b>";
        $text .= "\n";
        $text .= __("telegram.exchange_check_4", [], $language);
        $text .= " <b>".$amountTo." ".$direction->currencyTo->getTitle($language)."</b>";
        $text .= "\n";
        $text .= $appendText;
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text,
            'reply_markup' => [
                "inline_keyboard" => [
                    [
                        [
                            "text" =>__("telegram.exchange_check_edit", [], $language), 
                            "callback_data" => "backToExchangeSetFields:;:", 
                        ],
                        [
                            "text" =>__("telegram.exchange_check_create", [], $language), 
                            "callback_data" => "createExchange:;:", 
                        ],
                    ],
                    [
                        [
                            "text" =>__("telegram.exchange_check_back", [], $language), 
                            "callback_data" => "openExchangePageStep1:;:", 
                        ],
                    ],
                ]
            ],
        ]);
    }
}