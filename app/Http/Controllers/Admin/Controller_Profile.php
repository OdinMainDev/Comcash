<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}
