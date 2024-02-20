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
        if($exchange->status != 5){
            $text .= "\n".__("telegram.new_exchange_2", [], $language);
            $text .= "\n\n";
            $text .= __("telegram.new_exchange_3", [], $language);
            $text .= " <b>".$exchange->data['amount_data']['amount_send']." ".$exchange->currencyFrom->name."</b>";
            $text .= "\n".__("telegram.new_exchange_4", [], $language);
            $text .= " <b>".$exchange->data['merchant_from_data']['address']." ".$exchange->currencyFrom->name."</b>";
            $text .= "\n".__("telegram.new_exchange_5", [], $language);
        }
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
        if($exchange->status != 5)
            $text .= __("telegram.new_exchange_10", [], $language);
        return $text;
    }

    public function tgUserExchangeIPaidMessage($language){
        $text = __("telegram.exchange_status_i_paid", [], $language);
        return $text;
    }

    public function tgUserExchangeStartWithdrawMessage($language){
        $text = __("telegram.exchange_status_start_withdraw", [], $language);
        return $text;
    }

    public function tgUserExchangeCompleteWithdrawMessage($exchange, $language) {
        $text = __("telegram.exchange_status_complete_withdraw_1", [], $language);
        $text .= " <b>#".$exchange->id."</b>";
        $text .= " ".__("telegram.exchange_status_complete_withdraw_2", [], $language);
        $text .= "\n".__("telegram.exchange_status_complete_withdraw_3", [], $language);
        $text .= "\n".__("telegram.exchange_status_complete_withdraw_4", [], $language);
        return $text;
    }

    public function tgUserExchangeDeleteMessage($exchange, $language) {
        $text = __("telegram.exchange_status_delete_1", [], $language);
        $text .= " <b>#".$exchange->id."</b>";
        $text .= " ".__("telegram.exchange_status_delete_2", [], $language);
        $text .= "\n".__("telegram.exchange_status_delete_3", [], $language);
        return $text;
    }

    public function tgUserWithdrawStatusMessage($withdraw, $language) {
        $text = __("telegram.withdraw_status_".$withdraw->status, [], $language);
        $text .= " <b>#".$withdraw->id."</b>";
        $text .= "\n\n".__("telegram.withdraw_currency", [], $language);
        $text .= " ".$withdraw->getCurrency->getTitle($language);
        $text .= "\n".__("telegram.withdraw_amount", [], $language);
        $text .= " ".$withdraw->amount." ".$withdraw->getCurrency->name;

        if($withdraw->status == 2){
            $text .= "\n\n".__("telegram.withdraw_reason", [], $language);
            $text .= " ".$withdraw->reason;
        }
        return $text;
    }

    public function tgUserWithdrawStatusUpdateMessage($withdraw, $language) {
        $text = __("telegram.withdraw_status_updated", [], $language);
        $text .= "\n".__("telegram.withdraw_status_new_status", [], $language);
        $text .= " <b>".__("telegram.withdraw_status_".$withdraw->status, [], $language)."</b>";
        return $text;
    }

    public function tgUserExchangeStatusMessage($exchange, $language) {
        $text = __("telegram.exchange_status_completed", [], $language);
        $text .= " <b>#".$exchange->id."</b>";
        $text .= "\n\n".__("telegram.exchange_currency", [], $language);
        $text .= " ".$exchange->getCurrency->getTitle($language);
        $text .= "\n".__("telegram.exchange_amount", [], $language);
        $text .= " ".$exchange->amount." ".$exchange->getCurrency->name;
        $text .= " (".$exchange->amount_earned.")";
        return $text;
    }
}