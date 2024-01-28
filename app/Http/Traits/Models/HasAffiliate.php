<?php
     
namespace App\Http\Traits\Models;

use App\Models\AffiliateCampaign;
use App\Models\AffiliateUser;

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
}