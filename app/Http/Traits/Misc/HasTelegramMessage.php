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

}