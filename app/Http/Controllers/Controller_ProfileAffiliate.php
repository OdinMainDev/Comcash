<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\AffiliateCampaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class Controller_ProfileAffiliate extends Controller{

    use HasCache;

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

}
