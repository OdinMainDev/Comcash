<?php
     
namespace App\Http\Traits\Models;

use App\Models\Currency;
use App\Models\Direction;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

trait HasCache {

    public function getCacheDirections(){
        return Cache::remember("directions-public", 300, function(){
            $directions = Direction::where("status", true)
                ->with("currencyFrom")
                ->with("currencyTo")
                ->orderBy("position", "ASC")
                ->get();

            $currencies = $this->getCacheCurrencies();
            foreach($directions as $direction){
                $currency_from = false;
                $units = 2;
                foreach($currencies as $val){
                    if($val->id == $direction->currency_from){
                        $currency_from = $val->name;
                        $units = $val->units;
                        break;
                    }
                }
                if(!$currency_from){
                    $direction->status = false;
                    $direction->save();
                    continue;
                }
                $data = $direction->data;
                $data['min_amount'] = $this->estimateAmount("USD", $currency_from, $units, env("MIN_EXCHANGE_AMOUNT", 50), 0);
                $data['max_amount'] = $this->estimateAmount("USD", $currency_from, $units, env("MAX_EXCHANGE_AMOUNT", 50000), 0);
                $direction->data = $data;
                $direction->save();
            }
            return Direction::where("status", true)
                ->with("currencyFrom")
                ->with("currencyTo")
                ->orderBy("position", "ASC")
                ->get();
        });
    }

    public function getCacheCurrencies(){
        return Cache::remember("currencies-public", 3600, function(){
            return Currency::where("status", true)
                ->orderBy("position", "ASC")
                ->get();
        });
    }

    public function getCacheRates(){
        return Cache::remember("rates-public", 5, function(){
            return ExchangeRate::get();
        });
    }

    public function estimateAmount($currency_from, $currency_to, $minor_units, $amount, $profit_percent){
        $rate = $this->estimateGetRate($currency_from, $currency_to);

        if(!$rate){
            return false;
        }
        
        return ($amount * $rate) / 100 * (100 + $profit_percent);
    }

    public function estimateGetRate($currency_from, $currency_to){
        if(in_array($currency_from, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
            $currency_from = "RUB";
        }
        if(in_array($currency_from, ["USDTTRC20", "USDTERC20"])){
            $currency_from = "USDT";
        }

        if(in_array($currency_to, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
            $currency_to = "RUB";
        }
        if(in_array($currency_to, ["USDTTRC20", "USDTERC20"])){
            $currency_to = "USDT";
        }

        $rates = $this->getCacheRates();
        $rate = false;
        foreach($rates as $val){
            if($val->from == $currency_from && $val->to == $currency_to){
                $rate = floatval($val->rate);
                break;
            }
        }

        return $rate;
    }
}