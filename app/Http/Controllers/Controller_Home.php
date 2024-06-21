<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\AffiliateCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;


class Controller_Home extends Controller{

    use HasCache;

    public function view() {
        $this->setSeoData($this->constructSeoData("index", "index", $this->getCachedSeoData()));

        return view($this->theme.".index")
            ->with("news", $this->getCacheNews())
            ->with("feedbacks", $this->getCacheFeedbacks())
            ->with("exchanges", $this->getCacheExchanges());
    }

    public function export_json() {
        return $this->getCacheExportJson();
    }

    public function export_xml() {
        return response($this->getCacheExportXml(), 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    public function check_aff(Request $request, $lang, $hash) {
        if(mb_strlen($hash) != 32){
            return redirect(route("index"));
        }

        if ($request->cookie('aff_hash')) {
            return redirect(route("index"));
        }

        $check = AffiliateCampaign::where("hash", $hash)->first();
        if(!$check) {
            return redirect(route("index"));
        }

        Cookie::queue('aff_hash', $check->id, 365 * 86400 * 60);
        return redirect(constructUrlWithUtm($request, $lang));
    }
}
