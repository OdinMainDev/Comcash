<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasAffiliate;
use App\Models\AffiliateBalance;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateWithdraw;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_AffiliateWithdraw extends Controller{
    
    use HasAffiliate, HasTelegramMessage;

    public function view_settings() {
        $percent = $this->getAffilatePercent();
        $minamount = $this->getAffilateMinAmount();
        $currenciesList = $this->getAffilateCurrencies();
        $currencies = [];
        foreach($currenciesList as $id){
            $currency = Currency::where("id", $id)->first();
            if(!$currency){
                continue;
            }
            $currencies[$currency->id.": (".$currency->name.") ".@$currency->data['titles'][mb_strtolower(app()->getLocale())]] =  $currency->id;
        }
        
        return view("admin.pages.affiliate.settings.item")
            ->with("percent", $percent)
            ->with("minamount", $minamount)
            ->with("currencies", $currencies);
    }

    public function settings_process(Request $request){
        $request->validate([
            "percent" => "required|numeric",
            "minamount" => "required|numeric",
            "currencies" => "nullable|array",
            "currencies.*" => "integer|exists:App\Models\Currency,id",
        ]);

        $this->setAffilatePercent($request->percent);
        $this->setAffilateMinAmount($request->minamount);
        $this->setAffilateCurrencies($request->currencies);
        return $this->responseSuccess();
    }

    public function view($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $withdraw = AffiliateWithdraw::where("id", $id)->first();
        if(!$withdraw)
            return abort(404);
        
        return view("admin.pages.affiliate.withdraws.item")->with("model", $withdraw);
    }

    public function process(Request $request){
        $request->validate([
            "status" => "required|integer|min:1|max:2",
            "id" => "required|integer",
            "reason" => "nullable|string"
        ]);

        $model = AffiliateWithdraw::where("id", $request->id)->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }

        if($model->status != 0){
            return $this->responseErrorValidation(["undefined" => __("common.affiliate_withdraw_closed")]);
        }

        if($request->status == 1){
            $balance = AffiliateBalance::where("currency", $model->currency)->where("user_id", $model->user_id)->first();
            if(!$balance){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
            if($model->amount > $balance->balance){
                return $this->responseErrorValidation(["undefined" => __("common.affiliate_doesnt_have_balance")]);
            }
            $balance->decrement("balance", $model->amount);
        }

        $model->status = $request->status;
        $model->reason = $request->reason;
        $model->save();
        sendTelegramNotificationAffiliate("Закрыта заявка на выплату аффилейту");

        $user = $model->getUser;
        $botUsers = $user->getTelegramUsers;
        foreach($botUsers as $botUser){
            $language = $botUser->language;
            $text = $this->tgUserWithdrawStatusUpdateMessage($model, $language);
            sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
        }
        return $this->responseSuccess();
    }
}
