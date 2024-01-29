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
}