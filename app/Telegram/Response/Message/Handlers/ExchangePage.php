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
        $isReverse = $this->user->action != config("app.telegram_actions")['exchangeSumFrom'];
        $units = $direction->currencyFrom->units;
        if($isReverse){
            $units = $direction->currencyTo->units;
        }

        if(!@$direction->data['min_amount'] || $direction->data['min_amount'] > $textAmount){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_4");
        }
        if(!@$direction->data['max_amount'] || $direction->data['max_amount'] < $textAmount){
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_5");
        }

        $amount = $this->estimateAmount($direction->currencyFrom->name, $direction->currencyTo->name, $units, $textAmount, $direction->profit_percent, $isReverse);
        if(!$amount) {
            return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_3");
        }

        $this->user->action = config("app.telegram_actions")["exchangeSetFields"];
        $this->user->action_data = $directionId."_".$amount;
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
        $field = $direction->getLayoutAttribute()[$fieldIndex];

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
        $fields = $direction->getLayoutAttribute();
        $this->user->action = 0;
        $this->user->action_data = $this->user->action_data."_".$text;
        $this->user->save();
        // вычитаем 2 так как есть directionid_amount
        if(count($data) - 2 < count($fields)){
            $fieldIndex = count($fields) - count($data) - 2;
            $this->exchangeFieldMessage($chat_id, $language, $fieldIndex, $direction);
            return;
        }
        // это последний заполненный филд
        // выдаем сообщение подтверждения

        return $this->exchangeSetAmountErrorMessage($chat_id, $language, "exchange_create_error_2");
    }
}