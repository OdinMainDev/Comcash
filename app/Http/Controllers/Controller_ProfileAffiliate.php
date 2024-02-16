<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasAffiliate;
use App\Http\Traits\Models\HasCache;
use App\Models\AffiliateBalance;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateWithdraw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Controller_ProfileAffiliate extends Controller{

    use HasCache, HasAffiliate;

    public function view_index() {
        return view($this->theme.".pages.profile_affiliate")
            ->with("campaigns", $this->getCacheAffiliatesCampaigns(auth()->user()->id));
    }

    public function create_campaign(Request $request) {
        $request->validate([
            "name" => "required|string|min:2|max:255",
        ]);

        $count = AffiliateCampaign::where("user_id", auth()->user()->id)->where("status", true)->count();
        if($count > 25){
            return $this->responseErrorValidation(["code" => __("common.affiliate_campaigns_max")]);
        }

        $model = new AffiliateCampaign;
        $model->user_id = auth()->user()->id;
        $model->hash = md5(uniqid(auth()->user()->id).time());
        $model->name = $request->name;
        $model->save();

        Cache::forget("aff-campaigns-".auth()->user()->id);
        return $this->responseSuccess(false, ["refresh" => true]);
    }

    public function view_exchanges() {
        return view($this->theme.".pages.profile_affiliate_exchanges")
            ->with("exchanges", $this->getCacheAffiliatesExchanges(auth()->user()->id));
    }

    public function view_balances() {
        return view($this->theme.".pages.profile_affiliate_balance")
            ->with("balances", $this->getCacheAffiliatesBalances(auth()->user()->id));
    }

    public function withdraw_balance(Request $request) {
        $request->validate([
            "currency" => "required|integer",
            "amount" => "required|numeric|gt:0",
            "address" => "required|string|max:255"
        ]);

        $balance = AffiliateBalance::where("currency", $request->currency)->where("user_id", auth()->user()->id)->first();
        if(!$balance){
            return $this->responseErrorValidation(["code" => __("common.data_fail")]);
        }

        $amount = $this->estimateAmount($balance->getCurrency->name, "USD", 2, $request->amount, 0);
        if($amount < $this->getAffilatePercent()){
            return $this->responseErrorValidation(["code" => __("common.affiliate_withdraw_less_minimal")]);
        }

        if($balance->balance < $request->amount){
            return $this->responseErrorValidation(["code" => __("common.affiliate_withdraw_not_enough")]);
        }

        $check = AffiliateWithdraw::where("currency", $request->currency)->where("user_id", auth()->user()->id)->where("status", 0)->first();
        if($check){
            return $this->responseErrorValidation(["code" => __("common.affiliate_withdraw_already_created")]);
        }
        
        $withdraw = new AffiliateWithdraw;
        $withdraw->user_id = auth()->user()->id;
        $withdraw->currency = $request->currency;
        $withdraw->status = 0;
        $withdraw->amount = $request->amount;
        $withdraw->address = $request->address;
        $withdraw->save();
        sendTelegramNotificationAffiliate("Новая заявка на выплату аффилейту");

        return $this->responseSuccess();
    }

    public function view_withdraws() {
        return view($this->theme.".pages.profile_affiliate_withdraws")
            ->with("withdraws", $this->getCacheAffiliatesWithdraws(auth()->user()->id));
    }

}
