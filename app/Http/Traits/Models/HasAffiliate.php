<?php
     
namespace App\Http\Traits\Models;

use App\Models\AffiliateCampaign;
use App\Models\AffiliateUser;
use App\Models\ExchangerSettigns;

trait HasAffiliate {

    public function addUserToAffiliate($user, $aff_id){
        $aff_campaign = AffiliateCampaign::where("id", $aff_id)->where("status", true)->first();
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
        $model = ExchangerSettigns::where("key", "affiliate_percent")->first();
        if(!$model){
            $model = new ExchangerSettigns;
            $model->key = "affiliate_percent";
            $model->value = "0.5";
            $model->save();
        }
        return (float) $model->value;
    }

    public function setAffilatePercent($percent) {
        $model = ExchangerSettigns::where("key", "affiliate_percent")->first();
        if(!$model){
            $model = new ExchangerSettigns;
            $model->key = "affiliate_percent";
            $model->value = "0.5";
            $model->save();
        }
        $model->value = $percent;
        $model->save();
    }

    public function getAffilateMinAmount() {
        $model = ExchangerSettigns::where("key", "affiliate_minamount")->first();
        if(!$model){
            $model = new ExchangerSettigns;
            $model->key = "affiliate_minamount";
            $model->value = "100";
            $model->save();
        }
        return (float) $model->value;
    }

    public function setAffilateMinAmount($amount) {
        $model = ExchangerSettigns::where("key", "affiliate_minamount")->first();
        if(!$model){
            $model = new ExchangerSettigns;
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
        $aff_campaign->user_Id = $user->id;
        $aff_campaign->status = true;
        $aff_campaign->name = "telegramBotCampaign";
        $aff_campaign->registered_users = 0;
        $aff_campaign->profitable_transactions = 0;
        $aff_campaign->hash = md5(uniqid($user->id).time());
        $aff_campaign->save();
        return $aff_campaign;
    }
}