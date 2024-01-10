<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController{

    use AuthorizesRequests, ValidatesRequests, HasCache;

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

    public function getCurrencyByName($search_currencies = false) {
        if(!$search_currencies){
            return false;
        }
        $return = [];
        if(!is_array($search_currencies)){
            $search_currencies = [$search_currencies];
        }
        $currencies = $this->getCacheCurrencies();
        foreach($search_currencies as $key => $currency_name){
            foreach($currencies as $val){
                if($currency_name == $val->name){
                    $return[] = $val;
                }
            }
        }
        unset($currencies);
        return $return;
    }

    public function getDirectionByCurrencyPair($currency_from, $currency_to, $with_reverse_check = false){
        $directions = $this->getCacheDirections();

        $direction = false;
        foreach($directions as $val){
            if($val->currency_from != $currency_from->id){
                continue;
            }
            if($val->currency_to != $currency_to->id){
                continue;
            }
            $direction = $val;
            break;
        }
        if($direction) return $direction;
        if(!$with_reverse_check) return $direction;

        // проверяем обратную сторону
        foreach($directions as $val){
            if($val->currency_to != $currency_from->id){
                continue;
            }
            if($val->currency_from != $currency_to->id){
                continue;
            }
            $direction = $val;
            break;
        }
        return $direction;
    }

    public function getEstimateDataFromRequest($request, $with_reverse_check = false){
        $currencies = $this->getCurrencyByName([$request->currency_from, $request->currency_to]);
        $currency_from = @$currencies[0];
        $currency_to = @$currencies[1];
        unset($currencies);
        if(!$currency_to || !$currency_from){
            throw ValidationException::withMessages(["currency" => "currency not found"]);
        }
        $direction = $this->getDirectionByCurrencyPair($currency_from, $currency_to, $with_reverse_check);
        if(!$direction){
            throw ValidationException::withMessages(["currency_from" => "bad pair", "currency_to" => "bad pair"]);
        }
        $units = $currency_from->units;
        if(!$request->reverse){
            $units = $currency_to->units;
        }
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $units, $request->amount, $direction->profit_percent, $request->reverse);
        if(!$amount){
            throw ValidationException::withMessages(["currency" => "bad amount"]);
        }
        return [
            "amount" => $amount,
            "direction" => $direction,
            "currency_from" => $currency_from,
            "currency_to" => $currency_to,
        ];
    }

    public function getRealCurrencyCode($currency_code){
        return $this->convertCurrencyName($currency_code);
    }
}
