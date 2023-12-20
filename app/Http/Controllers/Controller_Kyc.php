<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\KycCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Controller_Kyc extends Controller{

    use HasCache;

    public function process(Request $request) {
        $request->validate([
            "file" => "required|image",
            "passport" => "required|image",
            "kyc_id" => "required|integer"
        ]);

        $kyc = KycCheck::where("id", $request->kyc_id)->first();
        if(!$kyc || $kyc->check){
            return $this->responseErrorValidation(["bad_data"]);
        }
        sendTelegramKycImage($kyc, $request->file("file")->getPathName());
        sendTelegramKycImage($kyc, $request->file("passport")->getPathName());

        return $this->responseSuccess();
    }

    public function check_by_admin(Request $request, $lang, $hash) {
        $decrypted = @Crypt::decryptString($hash);
        if(!$decrypted){
            return $this->responseErrorValidation(["bad_data"]); 
        }
        $decrypted = str_replace("comcashengine-", "", $decrypted);
        $kyc = KycCheck::where("id", $decrypted)->first();
        if(!$kyc || $kyc->check){
            return $this->responseSuccess();
        }
        $kyc->check = true;
        $kyc->save();
        sendTelegramKycSuccess($kyc);
        return $this->responseSuccess();
    }

    public function status(Request $request, $lang, $id) {
        $kyc = KycCheck::where("id", $id)->first();
        if(!$kyc || $kyc->check){
            return $this->responseError();
        }
        return json_encode([
            "success" => true,
            "data" => $kyc->check,
        ]);
    }
}
