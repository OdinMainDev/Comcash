<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\AffiliateCampaign;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_Affiliate extends Controller{

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $campaign = AffiliateCampaign::where("id", $id)->first();
        if(!$campaign)
            return abort(404);
        
        return view("admin.pages.affiliate.campaings.item")->with("model", $campaign);
    }

    public function process(Request $request){
        $request->validate([
            "enabled" => "required|boolean",
            "id" => "required|integer",
        ]);

        $model = AffiliateCampaign::where("id", $request->id)->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }
        
        $model->status = $request->enabled;
        $model->save();
        return $this->responseSuccess();
    }
}
