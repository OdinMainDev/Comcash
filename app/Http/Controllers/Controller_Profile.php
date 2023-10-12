<?php

namespace App\Http\Controllers;

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

    public function process_profile(Request $request) {
        $request->validate([
            "first_name" => "nullable|string|max:255",
            "second_name" => "nullable|string|max:255",
            "last_name" => "nullable|string|max:255",
            // "email" => "required|email|max:255",
            "telegram" => "nullable|string|max:255",
            "phone" => "nullable|string|max:255",
            "passport" => "nullable|string|max:255",
        ]);

        $user = Auth::user();
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
}
