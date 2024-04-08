<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\Currency;
use App\Models\Exchange;
use Illuminate\Http\Request;

class Controller_Api extends Controller{

    use HasCache;

    public function currencies(Request $request) {
        $currencies = $this->getCacheCurrencies();
        if($request->has("tag") && in_array($request->tag, ["fiat", "crypto"])){
            foreach($currencies as $key => $currency){
                if($currency->tag != $request->tag){
                    $currencies->forget($key);
                }
            }
        }
        return $currencies;
    }

    public function rates(){
        return $this->getCacheRates();
    }

    public function direction_settings(Request $request){
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
        ]);
        $currencies = $this->getCurrencyByName([ $request->currency_from, $request->currency_to]);
        if(!is_array($currencies) || count($currencies) < 2) {
            return $this->responseError("currency not found");
        }
        $currency_from = $currencies[0];
        $currency_to = $currencies[1];
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
            return $this->responseError("bad currency pair direction");
        }

        return $this->responseSuccess("ok", $direction);
    }

    public function estimate(Request $request){
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
            "reverse" => "boolean"
        ]);
        $data = $this->getEstimateDataFromRequest($request, $request->reverse);
        $amount = $data['amount'];
        $direction = $data['direction'];
        return $this->responseSuccess("ok", [
            "amount" => $amount, 
            "min_amount" => @$direction->data['min_amount'], 
            "max_amount" => @$direction->data['max_amount'], 
            "exchange_rate" => floatval($this->estimateGetRate($direction->currencyFrom->name, $direction->currencyTo->name))
        ]);
    }

    public function exchange_status(Request $request, $hash){
        $exch = Exchange::where("hash", $hash)->first();
        return $this->responseSuccess("ok", [
            "status" => $exch ? $exch->status : 15
        ]);
    }

    public function directions(){
        return $this->responseSuccess("ok", $this->getCacheDirections());
    }

    public function direction_currencies_from(){
        $directions = $this->getCacheDirections();
        $sorted = array_values($directions->pluck("currencyFrom")->unique()->toArray());
        return $this->responseSuccess("ok", $sorted);
    }
}
