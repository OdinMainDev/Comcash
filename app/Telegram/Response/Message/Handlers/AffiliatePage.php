<?php
     
namespace App\Telegram\Response\Message\Handlers;

use App\Http\Traits\Models\HasAffiliate;
use App\Http\Traits\Models\HasCache;
use App\Models\AffiliateBalance;
use App\Models\AffiliateWithdraw;
use Longman\TelegramBot\Request;

trait AffiliatePage {
    use HasCache, HasAffiliate;

    public function affWithdrawSetAmount($chat_id, $language, $textAmount){
        if(!is_numeric($textAmount)){
            return $this->affWithdrawSetErrorMessage($chat_id, $language);
        }
        $balanceId = $this->user->action_data;
        $balance = AffiliateBalance::where("id", $balanceId)->where("user_id", $this->user->user_id)->first();
        if(!$balance){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_2");
        }
        if($balance->balance < $textAmount){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_3");
        }
        $amountUsd = $this->estimateAmount($balance->getCurrency->name, "USD", 2, $textAmount, 0);
        if($amountUsd < $this->getAffilateMinAmount()){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_4");
        }

        $this->user->action = config("app.telegram_actions")["affiliateCreateWithdrawSetAddress"];
        $this->user->action_data = $this->user->action_data."_".$textAmount;
        $this->user->save();
        $text = __("telegram.aff_withdraw_set_address", [], $language);
        $text .= "\n";
        $text = __("telegram.aff_withdraw_set_address_2", [], $language);


        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text
        ]);
    }

    public function affWithdrawSetAddress($chat_id, $language, $textAddress){
        if(mb_strlen($textAddress) > 255 || count(explode("_", $this->user->action_data)) < 2){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_5");
        }
        $balanceId = explode("_", $this->user->action_data)[0];
        $textAmount = explode("_", $this->user->action_data)[1];
        if(count(explode("_", $this->user->action_data)) > 2){
            $textAddress = explode("_", $this->user->action_data)[2];
        }
        $balance = AffiliateBalance::where("id", $balanceId)->where("user_id", $this->user->user_id)->first();
        if(!$balance){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_2");
        }
        $check = AffiliateWithdraw::where("currency", $balance->currency)->where("user_id", $balance->user_id)->where("status", 0)->first();
        if($check){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_6");
        }

        $this->user->action = 0;
        $this->user->action_data = "";
        $this->user->save();
        $text = __("telegram.aff_withdraw_set_complete", [], $language);

        $keyboards = [];
        $keyboards[] = [
            [
                "text" =>__("telegram.aff_withdraw_do_withdraw_no", [], $language), 
                "callback_data" => "openCreateAffiliateWithdraw:;:", 
            ],
            [
                "text" =>__("telegram.aff_withdraw_do_withdraw_yes", [], $language), 
                "callback_data" => "finishDoWithdraw:;:".$balanceId."_".$textAmount."_".$textAddress, 
            ]
        ];
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text,
            'reply_markup' => [
                "inline_keyboard" => $keyboards
            ],
        ]);
    }

    public function affWithdrawFinish($chat_id, $language){
        if(count(explode("_", $this->user->action_data)) < 3){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_5");
        }
        $balanceId = explode("_", $this->user->action_data)[0];
        $textAmount = explode("_", $this->user->action_data)[1];
        $textAddress = explode("_", $this->user->action_data)[2];
        $balance = AffiliateBalance::where("id", $balanceId)->where("user_id", $this->user->user_id)->first();
        if(!$balance){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_2");
        }
        $amountUsd = $this->estimateAmount($balance->getCurrency->name, "USD", 2, $textAmount, 0);
        if($amountUsd < $this->getAffilateMinAmount()){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_4");
        }
        $check = AffiliateWithdraw::where("currency", $balance->currency)->where("user_id", $balance->user_id)->where("status", 0)->first();
        if($check){
            return $this->affWithdrawSetErrorMessage($chat_id, $language, "aff_withdraw_error_6");
        }

        $this->user->action = 0;
        $this->user->action_data = "";
        $this->user->save();

        $withdraw = new AffiliateWithdraw;
        $withdraw->user_id = $balance->user_id;
        $withdraw->currency = $balance->currency;
        $withdraw->status = 0;
        $withdraw->amount = $textAmount;
        $withdraw->address = $textAddress;
        $withdraw->save();
        // sendTelegramNotificationAffiliate("Новая заявка на выплату аффилейту");


        $text = __("telegram.aff_withdraw_success_create_withdraw", [], $language);
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  $text
        ]);
    }

    public function affWithdrawSetErrorMessage($chat_id, $language, $message = "aff_withdraw_error_1", $additional_data = "") {
        Request::sendMessage([
            'chat_id' => $chat_id,
            'parse_mode' => 'html',
            'text' =>  __("telegram.".$message, [], $language)." ".$additional_data,
        ]);
    }
}