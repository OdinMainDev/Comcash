<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController{

    use AuthorizesRequests, ValidatesRequests;

    public $theme = "";
    public function __construct(){
        $this->theme = env("THEME_NAME", "comcash");
    }

    public function responseError($message = false, $data = []){
        if(!$message){
            $message = __("common.action_fail");
        }
        return json_encode([
            "success" => false,
            "title" => $message,
            "data" => $data
        ]);
    }

    public function responseSuccess($message = false, $data = []){
        if(!$message){
            $message = __("common.action_success");
        }
        return json_encode([
            "success" => true,
            "title" => $message,
            "data" => $data
        ]);
    }

    public function checkThrottling($key, $countPerMinute = 5){
        $executed = RateLimiter::attempt(
            $key,
            $perMinute = $countPerMinute,
            function() {}
        );

        if(!$executed){
            $this->responseErrorValidation([
                __("common.throttle", ["seconds" => 60])
            ]);
        }
    }

    public function responseErrorValidation($data){
        throw ValidationException::withMessages($data);
    }
}
