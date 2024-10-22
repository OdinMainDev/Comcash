<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FALaravel\Facade as Google2FA;

class Controller_Profile extends Controller
{
    use HasImage;
    
    public function view() {
        return view("admin.pages.profile");
    }

    public function process(Request $request){
        $request->validate([
            "oldpassword" => "required|string|max:255",
            "password" => "required|string|max:255",
            "repassword" => "required|string|max:255|same:password",
        ]);

        $user = Auth::user();
        if(!Hash::check($request->oldpassword, $user->password)){
            return $this->responseErrorValidation(["oldpassword" => __("common.old_password_incorrect")]);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        return $this->responseSuccess();
    }
    
    public function view2fa() {
        $user = auth()->user();
        $googleHandler = app('pragmarx.google2fa');
        $secret = $googleHandler->generateSecretKey();

        $qrImage = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($googleHandler->getQRCodeUrl(
            config('app.name'),
            "id".$user->id,
            $secret
        ));
        return view("admin.pages.profile_2fa")->with("secret", $secret)->with("qrcode", $qrImage);
    }

    public function process2fa(Request $request) {
        $request->validate([
            "otppassword" => "required|integer|min:0|max:999999",
            "otpsecret" => "required|string|max:255",
        ]);

        $user = Auth::user();
        $googleHandler = app('pragmarx.google2fa');

        if (!$googleHandler->verifyKey($request->otpsecret, $request->otppassword)) {
            return $this->responseErrorValidation(["otppassword" => __("common.otp_password_incorrect")]);
        }

        $user->google2fa_secret = $request->otpsecret;
        $user->save();
        return $this->responseSuccess();
    }
}
