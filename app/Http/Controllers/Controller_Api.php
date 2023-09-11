<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_Api extends Controller{

    use HasCache;

    public function currencies() {
        return $this->getCacheCurrencies();
    }

    public function rates(){
        return $this->getCacheRates();
    }

    public function direction_settings(Request $request){
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
        ]);
        $currencies = $this->getCacheCurrencies();
        foreach($currencies as $val){
            if($val->name == $request->currency_from){
                $currency_from = $val;
            }
            if($val->name == $request->currency_to){
                $currency_to = $val;
            }
        }
        unset($currencies);
        if(!$currency_to || !$currency_from){
            return $this->responseError("currency not found");
        }

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
        if(!$direction){
            return $this->responseError("bad currency pair");
        }

        return $this->responseSuccess("on", $direction);
    }

    public function estimate(Request $request){
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
        ]);
        $currencies = $this->getCacheCurrencies();
        $currency_from = false;
        $currency_to = false;
        foreach($currencies as $val){
            if($val->name == $request->currency_from){
                $currency_from = $val;
            }
            if($val->name == $request->currency_to){
                $currency_to = $val;
            }
        }
        unset($currencies);
        if(!$currency_to || !$currency_from){
            return $this->responseError("currency not found");
        }

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
        if(!$direction){
            return $this->responseError("bad currency pair");
        }
        unset($directions);
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_from->units, $request->amount, $direction->profit_percent);
        if(!$amount){
            return $this->responseError("bad amount");
        }
        return $this->responseSuccess("ok", ["amount" => $amount, "min_amount" => @$direction->data['min_amount'], "exchange_rate" => sprintf("%.0f", $this->estimateGetRate($direction->currencyFrom->name, $direction->currencyTo->name))]);
    }
}
