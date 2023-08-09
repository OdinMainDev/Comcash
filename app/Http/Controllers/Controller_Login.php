<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Controller_Login extends Controller
{
    public function view() {
        if(Auth::check())
            return abort(404);
        return view("admin.pages.auth.login");
    }

    public function process(Request $request){
        if(Auth::check())
            return abort(404);

        $request->validate([
            "email" => "required|email|string|max:255",
            "password" => "required|string|max:255",
        ]);
        $this->checkThrottling($request);

        $user = User::where("email", $request->email)->first();
        if(!$user){
            return $this->responseError(__("auth.failed"));
        }

        if(!Hash::check($request->password, $user->password)){
            return $this->responseError(__("auth.failed"));
        }

        Auth::login($user, $request->has('remember'));
        return $this->responseSuccess(__("common.action_success"));
    }
}
