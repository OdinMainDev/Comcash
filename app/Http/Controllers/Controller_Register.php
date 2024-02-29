<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasAffiliate;
use App\Jobs\OnRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller_Register extends Controller
{
    use HasAffiliate;

    public function process(Request $request){
        if(Auth::check())
            return abort(404);

        $request->validate([
            "email" => "required|email|string|max:255",
            "password" => "required|string|min:6|max:255",
            "repassword" => "required|same:password|string|min:6|max:255",
        ]);
        
        $this->checkThrottling($request->email."-register");

        $user = User::where("email", $request->email)->first();
        if($user){
            return $this->responseErrorValidation(['email' => __("common.email_already_register")]);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $aff_id = $request->cookie("aff_hash");
        if($aff_id){
            $this->addUserToAffiliate($user, $aff_id);
        }

        OnRegister::dispatch($user->id, app()->getLocale());
        Auth::login($user, true);
        return $this->responseSuccess(__("common.register_success"), [
            "open_modal" => 'verification-sent'
        ]);
    }

    public function confirm_email(Request $request, $lang, $id, $hash) {
        if(!is_numeric($id)){
            return abort(404);
        }
        if(!is_string($hash) || mb_strlen($hash) > 255){
            return abort(404);
        }
        $user = User::where("id", $id)->first();
        if(!$user || $user->email_verified_at > 0 || $hash != md5($user->id.$user->email."VerifyCmHash")){
            return abort(404);
        }

        $user->email_verified_at = time();
        $user->save();
        return redirect("/");
    } 
}
