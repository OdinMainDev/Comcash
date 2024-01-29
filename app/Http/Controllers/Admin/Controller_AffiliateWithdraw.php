<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Http\Traits\Models\HasAffiliate;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateWithdraw;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_AffiliateWithdraw extends Controller{
    
    use HasAffiliate;

    public function view_settigns() {
        $percent = $this->getAffilatePercent();
        
        return view("admin.pages.affiliate.settings.item")->with("percent", $percent);
    }

    public function settigns_process(Request $request){
        $request->validate([
            "percent" => "required|numeric",
        ]);

        $this->setAffilatePercent($request->percent);
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

        $model->status = $request->status;
        $model->reason = $request->reason;
        $model->save();
        sendTelegramNotification("Закрыта заявка на выплату аффилейту");
        return $this->responseSuccess();
    }
}
