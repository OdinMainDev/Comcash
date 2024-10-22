<?php

namespace App\Http\Controllers;

use App\Jobs\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller_Profile extends Controller{

    public function view() {
        return view($this->theme.".pages.profile");
    }

    public function view_password() {
        return view($this->theme.".pages.profile_password");
    }

    public function view_exchanges() {
        return view($this->theme.".pages.profile_exchanges")->with("exchanges", $this->getCacheExchanges(auth()->user()->id));
    }

    public function view_2fa() {
        $user = auth()->user();
        $googleHandler = app('pragmarx.google2fa');
        $secret = $googleHandler->generateSecretKey();

        $qrImage = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($googleHandler->getQRCodeUrl(
            config('app.name'),
            "id".$user->id,
            $secret
        ));
        return view($this->theme.".pages.profile_2fa")->with("secret", $secret)->with("qrcode", $qrImage);
    }

    public function process_profile(Request $request) {
        $request->validate([
            "first_name" => "nullable|string|max:255",
            "second_name" => "nullable|string|max:255",
            "last_name" => "nullable|string|max:255",
            "email" => "nullable|string|email|max:255",
            "telegram" => "nullable|string|max:255",
            "phone" => "nullable|string|max:255",
            "passport" => "nullable|string|max:255",
        ]);

        $user = Auth::user();
        if($user->email_verified_at == 0) {
            if($request->email && $request->email != $user->email){
                $check = User::where("email", $request->email)->first();
                if($check){
                    return $this->responseErrorValidation(["email" => __("common.email_already_taken")]);
                }
                $user->email = $request->email;
            }
        }
        $user->first_name = $request->first_name;
        $user->second_name = $request->second_name;
        $user->last_name = $request->last_name;
        $user->telegram = $request->telegram;
        $user->phone = $request->phone;
        $user->passport = $request->passport;
        $user->save();

        return $this->responseSuccess();
    }

    public function process_password(Request $request) {
        $request->validate([
            "oldpassword" => "required|string|min:6|max:255",
            "password" => "required|string|min:6|max:255",
            "repassword" => "required|same:password|string|min:6|max:255",
        ]);
        
        $user = Auth::user();
        if(!Hash::check($request->oldpassword, $user->password)){
            return $this->responseErrorValidation(["oldpassword" => __("common.old_password_invalid")]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->responseSuccess();
    }

    public function process_verify_start(Request $request) {
        $user = auth()->user();
        if($user->email && $user->email[0] == "@"){
            return $this->responseErrorValidation(["email" => __("common.bad_email_save_before_verify")]);
        }
        $this->checkThrottling("verify-".$user->email, 1);
        VerifyEmail::dispatch($user->id, app()->getLocale());
        return $this->responseSuccess();
    }
}
