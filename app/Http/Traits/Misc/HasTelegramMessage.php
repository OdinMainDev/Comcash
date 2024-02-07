<?php
     
namespace App\Http\Traits\Misc;

trait HasTelegramMessage {

    public function tgBasicMessage($exchange){
        $text = "ID: ".$exchange->id."\n";
        $text .= "Направление обмена ".$exchange->currencyFrom->name." -> ".$exchange->currencyTo->name."\n";
        $text .= "Сумма: ". @$exchange->data['amount_data']['amount_send']." -> ". @$exchange->data['amount_data']['amount_receive']."\n";
        $text .= "Курс обмена:". @$exchange->data['amount_data']['exchange_rate']."\n";
        $text .= "Дата создания: ".$exchange->created_at."\n\n";
        return $text;
    }

    public function tgUserExchangeStartMessage($exchange, $language) {
        $text = __("telegram.new_exchange_1", [], $language);
        $text .= " <b>#".$exchange->id."</b>";
        $text .= "\n".__("telegram.new_exchange_2", [], $language);
        $text .= "\n\n";
        $text .= __("telegram.new_exchange_3", [], $language);
        $text .= " <b>".$exchange->data['amount_data']['amount_send']." ".$exchange->currencyFrom->name."</b>";
        $text .= "\n".__("telegram.new_exchange_4", [], $language);
        $text .= " <b>".$exchange->data['merchant_from_data']['address']." ".$exchange->currencyFrom->name."</b>";
        $text .= "\n".__("telegram.new_exchange_5", [], $language);
        $text .= "\n\n".__("telegram.new_exchange_6", [], $language);
        $text .= "\n".__("telegram.new_exchange_7", [], $language);
        $text .= " <b>".$exchange->currencyFrom->getTitle($language)." -> ".$exchange->currencyTo->getTitle($language)."</b>";
        $text .= "\n".__("telegram.new_exchange_8", [], $language);
        $text .= " <b>".$exchange->data['amount_data']['amount_send']." ".$exchange->currencyFrom->getTitle($language)."</b>";
        $text .= "\n".__("telegram.new_exchange_9", [], $language);
        $text .= " <b>".$exchange->data['amount_data']['amount_receive']." ".$exchange->currencyTo->getTitle($language)."</b>";
        if(isset($exchange->data['request_data']['from_card'])){
            $text .= "\n".__("telegram.new_exchange_field_from_card", [], $language);
            $text .= " <b>".$exchange->data['request_data']['from_card']."</b>";
        }
        if(isset($exchange->data['request_data']['to_address'])){
            $text .= "\n".__("telegram.new_exchange_field_to_address", [], $language);
            $text .= " <b>".$exchange->data['request_data']['to_address']."</b>";
        }
        if(isset($exchange->data['request_data']['to_card'])){
            $text .= "\n".__("telegram.new_exchange_field_to_card", [], $language);
            $text .= " <b>".$exchange->data['request_data']['to_card']."</b>";
        }
        $text .= "\n\n";
        $text .= __("telegram.new_exchange_10", [], $language);
        return $text;
    }

}