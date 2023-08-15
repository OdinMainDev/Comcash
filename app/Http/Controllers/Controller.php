<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

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

    public function checkThrottling($key){
        $executed = RateLimiter::attempt(
            $key,
            $perMinute = 5,
            function() {}
        );

        if(!$executed){
            $this->responseError(__("common.throttle", ["seconds" => 60]));
        }
    }

    public function responseErrorValidation($data){
        throw ValidationException::withMessages($data);
    }
}
