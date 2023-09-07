<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasConfirmCode;
use App\Jobs\OnReset;
use App\Models\ConfirmCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller_ResetPassword extends Controller{

    use HasConfirmCode;

    public function reset_process(Request $request){
        if(Auth::check())
            return abort(404);

        $request->validate([
            "email" => "required|email|string|max:255",
        ]);
        
        $this->checkThrottling($request->email."-reset", 1);

        $user = User::where("email", $request->email)->first();
        if(!$user){
            return $this->responseSuccess(__("common.password_reset_success"), [
                "open_modal" => 'recover-password',
                "hash" => md5(uniqid().time()."CCsaltVio")
            ]);
        }

        $code = $this->createConfirmCode(1, $user->id);

        OnReset::dispatch($user->id, app()->getLocale(), $code->code);
        return $this->responseSuccess(__("common.password_reset_success"), [
            "open_modal" => 'recover-password',
            "hash" => $code->hash
        ]);
    }

    public function confirm_process(Request $request){
        if(Auth::check())
            return abort(404);

        $request->validate([
            "hash" => "required|string|min:32|max:32",
            "code" => "required|integer|min:100000|max:99999999",
            "password" => "required|string|min:6|max:255",
            "repassword" => "required|same:password|string|min:6|max:255",
        ]);

        $this->checkThrottling($request->hash."-reset-confirm");
        $code = ConfirmCode::where("hash", $request->hash)->where("type", 1)->first();
        if(!$code || $code->code != $request->code || $code->created_at < time() - 7200){
            return $this->responseErrorValidation(["code" => __("common.password_reset_code_invalid")]);
        }

        $user = User::where("id", $code->user_id)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        $code->delete();

        return $this->responseSuccess(__("common.reset_password_success"), [
            "refresh" => true
        ]);
    }
}
