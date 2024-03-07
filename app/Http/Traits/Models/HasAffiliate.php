<?php
     
namespace App\Http\Traits\Models;

use App\Models\AffiliateCampaign;
use App\Models\AffiliateUser;
use App\Models\ExchangerSettings;

trait HasAffiliate {

    public function addUserToAffiliate($user, $aff_id = false, $aff_hash = false){
        if($aff_id)
            $aff_campaign = AffiliateCampaign::where("id", $aff_id)->where("status", true)->first();
        else 
            $aff_campaign = AffiliateCampaign::where("hash", $aff_hash)->where("status", true)->first();
        if(!$aff_campaign){
            return;
        }

        $aff_user = new AffiliateUser;
        $aff_user->user_id = $user->id;
        $aff_user->campaign_id = $aff_campaign->id;
        $aff_user->save();

        $aff_campaign->increment("registered_users");
    }

    public function getAffiliatedUser($user_id){
        return AffiliateUser::with("campaign")->where("user_id", $user_id)->first();
    }

    public function getAffilatePercent() {
        $model = ExchangerSettings::where("key", "affiliate_percent")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_percent";
            $model->value = "0.5";
            $model->save();
        }
        return (float) $model->value;
    }

    public function setAffilatePercent($percent) {
        $model = ExchangerSettings::where("key", "affiliate_percent")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_percent";
            $model->value = "0.5";
            $model->save();
        }
        $model->value = $percent;
        $model->save();
    }

    public function getAffilateMinAmount() {
        $model = ExchangerSettings::where("key", "affiliate_minamount")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_minamount";
            $model->value = "100";
            $model->save();
        }
        return (float) $model->value;
    }

    public function setAffilateMinAmount($amount) {
        $model = ExchangerSettings::where("key", "affiliate_minamount")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_minamount";
            $model->value = "100";
            $model->save();
        }
        $model->value = $amount;
        $model->save();
    }

    public function getTelegramUserCampaign($user){
        $aff_campaign = AffiliateCampaign::where("user_id", $user->id)->where("status", true)->where("name", "telegramBotCampaign")->first();
        if($aff_campaign){
            return $aff_campaign;
        }
        $aff_campaign = new AffiliateCampaign;
        $aff_campaign->user_id = $user->id;
        $aff_campaign->status = true;
        $aff_campaign->name = "telegramBotCampaign";
        $aff_campaign->registered_users = 0;
        $aff_campaign->profitable_transactions = 0;
        $aff_campaign->hash = md5(uniqid($user->id).time());
        $aff_campaign->save();
        return $aff_campaign;
    }

    public function getAffilateCurrencies() {
        $model = ExchangerSettings::where("key", "affiliate_currencies")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_currencies";
            $model->value = json_encode([]);
            $model->save();
        }
        return json_decode($model->value, true);
    }

    public function setAffilateCurrencies($currencies) {
        $model = ExchangerSettings::where("key", "affiliate_currencies")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_currencies";
            $model->value = json_encode([]);
            $model->save();
        }
        if(!is_array($currencies)){
            return;
        }
        $model->value = json_encode($currencies);
        $model->save();
    }

    public function getAffilateUsdtOnly() {
        $model = ExchangerSettings::where("key", "affiliate_usdt_only")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_usdt_only";
            $model->value = "0";
            $model->save();
        }
        return (int) $model->value;
    }

    public function setAffilateUsdtOnly($status) {
        $model = ExchangerSettings::where("key", "affiliate_usdt_only")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "affiliate_usdt_only";
            $model->value = "0";
            $model->save();
        }
        $model->value = $status;
        $model->save();
    }
}