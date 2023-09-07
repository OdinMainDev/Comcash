<?php

namespace App\Http\Controllers;

use App\Jobs\OnRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller_Register extends Controller
{
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

        OnRegister::dispatch($user->id, app()->getLocale());
        Auth::login($user, true);
        return $this->responseSuccess(__("common.register_success"), [
            "open_modal" => 'verification-sent'
        ]);
    }
}
