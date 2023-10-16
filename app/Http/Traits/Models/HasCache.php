<?php
     
namespace App\Http\Traits\Models;

use App\Models\Blog;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Cache;

trait HasCache {
    
    public function getCacheDirections(){
        return Cache::remember("directions-public", 300, function(){
            $directions = Direction::where("status", true)
                ->whereHas("currencyFrom", function($q){
                    $q->where("status", true);
                })
                ->whereHas("currencyTo", function($q){
                    $q->where("status", true);
                })
                ->whereHas("merchantFrom", function($q){
                    $q->where("status", true);
                })
                ->whereHas("merchantTo", function($q){
                    $q->where("status", true);
                })
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
                $data['min_amount'] = $this->estimateAmount("USD", $currency_from, $units, env("MIN_EXCHANGE_AMOUNT", 50), $direction->profit_percent);
                $data['max_amount'] = $this->estimateAmount("USD", $currency_from, $units, env("MAX_EXCHANGE_AMOUNT", 50000), $direction->profit_percent);
                $direction->data = $data;
                $direction->save();
            }
            return Direction::where("status", true)
                ->whereHas("currencyFrom", function($q){
                    $q->where("status", true);
                })
                ->whereHas("currencyTo", function($q){
                    $q->where("status", true);
                })
                ->orderBy("position", "ASC")
                ->whereHas("merchantFrom", function($q){
                    $q->where("status", true);
                })
                ->whereHas("merchantTo", function($q){
                    $q->where("status", true);
                })
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
        return $this->doEstimate($amount, $rate, $profit_percent, $minor_units);
    }

    public function doEstimate($amount, $rate, $profit_percent, $minor_units){
        return number_format(($amount * $rate) / 100 * (100 - $profit_percent), $minor_units, ".", "");
    }

    public function estimateGetRate($currency_from, $currency_to){
        $currency_from = $this->convertCurrencyName($currency_from);
        $currency_to = $this->convertCurrencyName($currency_to);

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

    public function format_amount($amount, $minor_units){
        return number_format($amount, $minor_units, ".", "");
    }

    public function getCacheNews(){
        $request = request();
        return Cache::remember("news-public-".$request->page, 600, function(){
            return Blog::where("status", true)
                ->orderBy("id", "DESC")
                ->paginate(10);
        });
    }

    public function getCacheExportJson(){
        return Cache::remember("export-json-public", 3600, function(){
            $currencies = $this->getCacheCurrencies();
            $response = [
                "version" => "1.3",
                "currencies" => [
                    "list" => []
                ],
                "exchange" => []
            ];
            foreach($currencies as $currency) {
                $response["currencies"]["list"][$currency->id] = $currency->name;
            }

            foreach($currencies as $currency){
                $response["exchange"][$currency->id]["to"] = [];
                foreach($currencies as $currency2){
                    if($currency2->id == $currency->id)
                        continue;

                    $direction = $this->getDirectionByCurrencyPair($currency, $currency2);
                    if(!$direction)
                        continue;

                    $rate = $this->estimateGetRate($currency->name, $currency2->name);
                    if($rate < 0.01){
                        $rate = $this->estimateGetRate($currency2->name, $currency->name); 
                    }
                    $response["exchange"][$currency->id]["to"][$currency2->id] = [
                        "xr" => $rate,
                        "min" => @$direction->data['min_amount'],
                        "max" => @$direction->data['max_amount']
                    ];
                }
            }
            return $response;
        });
    }

    public function convertCurrencyName($currency){
        if(in_array($currency, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
            $currency = "RUB";
        }
        if(in_array($currency, ["USDTTRC20", "USDTERC20"])){
            $currency = "USDT";
        }

       return $currency;
    }

    public function recalculateExchange($exchange, $amount){
        $data = $exchange->data;
        $rate = $data['amount_data']['exchange_rate'];
        $new_rate = $this->estimateGetRate($exchange->currencyFrom->name, $exchange->currencyTo->name);
        if($new_rate){
            if($new_rate < $rate) {
                $rate = $new_rate;
            }
        }

        $data['recalculate']['has_recalculation'] = true;
        $data['recalculate']['old_amount_send'] = $data['amount_data']['amount_send'];
        $data['recalculate']['old_amount_receive'] = $data['amount_data']['amount_receive'];
        $data['recalculate']['old_exchange_rate'] = $data['amount_data']['exchange_rate'];

        $data['amount_data']['exchange_rate'] = $rate;
        $data['amount_data']['amount_send'] = $amount;
        $data['amount_data']['amount_receive'] = $this->doEstimate($amount, $rate, $exchange->getDirection->profit_percent, $exchange->currencyTo->units);
        $exchange->data = $data;
        $exchange->status = 1;
        // $exchange->save();
        return $exchange;
    }
}