<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Http\Traits\Models\HasAffiliate;
use App\Models\AffiliateCampaign;
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
}
