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
        $this->setSeoData($this->constructSeoData("login", "login", $this->getCachedSeoData()));
        return view($this->theme.".index")->with("auth_modal", true);
    }
    
    public function view_register() {
        if(Auth::check())
            return abort(404);
        $this->setSeoData($this->constructSeoData("register", "register", $this->getCachedSeoData()));
        return view($this->theme.".index")->with("auth_modal", true);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
      }

    public function process(Request $request){
        if(Auth::check())
            return abort(404);

        $request->validate([
            "email" => "required|email|string|max:255",
            "password" => "required|string|max:255",
        ]);
        
        $this->checkThrottling($request->email."-login");

        $user = User::where("email", $request->email)->first();
        if(!$user){
            return $this->responseErrorValidation(['email' => __("auth.failed"), 'password' => __("auth.failed"), ]);
        }

        if(!Hash::check($request->password, $user->password)){
            return $this->responseErrorValidation(['email' => __("auth.failed"), 'password' => __("auth.failed"), ]);
        }

        Auth::login($user, true);
        return $this->responseSuccess(__("common.auth_success"), [
            "redirect" => "/"
        ]);
    }
}
