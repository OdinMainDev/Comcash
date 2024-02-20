<?php
     
namespace App\Http\Traits\Models;

use App\Models\AffiliateBalance;
use App\Models\AffiliateCampaign;
use App\Models\AffiliateExchange;
use App\Models\AffiliateWithdraw;
use App\Models\Blog;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\Exchange;
use App\Models\ExchangeRate;
use App\Models\ExchangerSettigns;
use App\Models\Feedback;
use Illuminate\Support\Facades\Cache;

trait HasCache {
    
    public function getCacheDirections(){
        $cached = Cache::get("directions-public");
        if(!$cached){
            return Direction::where("currency_from", -1)->get();
        }
        return $cached;
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

    public function estimateAmount($currency_from, $currency_to, $minor_units, $amount, $profit_percent, $reverse = false){
        $rate = $this->estimateGetRate($currency_from, $currency_to);

        if(!$rate){
            return false;
        }
        
        if(!$reverse)
            return $this->doEstimate($amount, $rate, $profit_percent, $minor_units);

        return $this->doEstimateReverse($amount, $rate, $profit_percent, $minor_units);
    }

    public function doEstimate($amount, $rate, $profit_percent, $minor_units){
        // return number_format(($amount * $rate) / 100 * (100 - $profit_percent), $minor_units, ".", "");
        $amount = round(fdiv(($amount * $rate), 100) * (100 - $profit_percent), $minor_units);
        return number_format($amount, $minor_units, ".", "");
    }

    public function doEstimateReverse($amount, $rate, $profit_percent, $minor_units){
        $amount = round(fdiv(fdiv($amount, $rate), 100 - $profit_percent) * 100, $minor_units);
        return number_format($amount, $minor_units, ".", "");
    }

    public function estimateGetRate($currency_from, $currency_to, $with_fee = false){
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

        if($with_fee && $rate){
            $rate = fdiv($rate, 100) * (100 - $with_fee);
        }

        return $rate;
    }

    public function format_amount($amount, $minor_units){
        return number_format($amount, $minor_units, ".", "");
    }

    public function getCacheNews($is_blog = false){
        $request = request();
        return Cache::remember("news-public-".($is_blog ? "blog" : "")."-".$request->page, 600, function() use($is_blog){
            return Blog::where("status", true)->where("is_blog", $is_blog)
                ->orderBy("id", "DESC")
                ->paginate(10);
        });
    }


    public function getCacheNewsItem($id){
        return Cache::remember("news-public-item-".$id, 600, function() use($id){
            return Blog::where("status", true)
                ->orderBy("id", "DESC")
                ->where("id", $id)
                ->first();
        });
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

                    $rate = $this->estimateGetRate($currency->name, $currency2->name, $direction->profit_percent);
                    if($rate < 0.01){
                        $rate = $this->estimateGetRate($currency2->name, $currency->name, $direction->profit_percent); 
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

        if(@$exchange->getDirection->data['min_amount'] && $data['amount_data']['amount_receive'] < $exchange->getDirection->data['min_amount']){
            $exchange->status = 14;
        }

        $exchange->save();
        return $exchange;
    }

    public function getCacheFeedbacks(){
        $request = request();
        return Cache::remember("feedbacks-".$request->page, 600, function(){
            return Feedback::orderBy("id", "DESC")
                ->paginate(10);
        });
    }

    public function getCacheExchanges($user_id = 0, $page_number = false){
        $request = request();
        if($request->page && !is_numeric($request->page)){
            return abort(404);
        }
        if($request->page >= 10) {
            $request->page = 10;
        }
        return Cache::remember("exchanges-".$request->page."-".$user_id."-".$page_number, 600, function() use($user_id, $page_number){
            $query = Exchange::with("currencyFrom")
                ->with("currencyTo")
                ->orderBy("id", "DESC")
                ->where("status", 5);
            if($user_id){
                $query = $query->where("user_id", $user_id);
            }

            if($page_number)
                return $query->limit(10)->offset(($page_number - 1 ) * 10)->get();

            return $query->paginate(10);
        });
    }

    public function getCacheExportXml(){
        return Cache::remember("export-xml-public", 3600, function(){
            $xml = "<rates>";
            $currencies = $this->getCacheCurrencies();

            foreach($currencies as $currency){
                foreach($currencies as $currency2){
                    if($currency2->id == $currency->id)
                        continue;

                    $direction = $this->getDirectionByCurrencyPair($currency, $currency2);
                    if(!$direction)
                        continue;

                    $rate = $this->estimateGetRate($currency->name, $currency2->name, $direction->profit_percent);
                    if($rate < 0.01){
                        $rate = $this->estimateGetRate($currency2->name, $currency->name, $direction->profit_percent); 
                    }

                    $citiesForCash = [
                        "MSK",
                        "MOSCOW",
                        "SPB",
                        "STPETERSBURG",
                        "KAZAN",
                        "KZN",
                        "NSK",
                        "SIMF",
                        "SMF",
                        "KRASN",
                        "KRD",
                        "KRASNODAR",
                        "EKB",
                        "CHEL",
                        "CHELYABINSK",
                        "OREN",
                        "ORENBURG",
                        "UFA",
                        "SOCHI",
                        "RND",
                        "RSTV",
                        "ROSTOV",
                        "RSND",
                        "ROSTOV-NA-DONU",
                        "SAMARA",
                        "SMR",
                        "IRK",
                        "OMSK",
                        "PERM",
                        "IZHV",
                        "VORON",
                        "VORONEZH",
                    ];
                    $countOfIterations = 1;
                    if(in_array($currency2->name, ["CASHRUB"])){
                        $countOfIterations = count($citiesForCash);
                    }
                    for($i = 0; $i < $countOfIterations; $i++){
                        $xml .= "<item>";
                        $xml .= "<from>".$currency->name."</from>";
                        $xml .= "<to>".$currency2->name."</to>";
                        $xml .= "<in>1</in>"; // CONSTANT
                        $xml .= "<out>".$rate."</out>";
                        $xml .= "<amount>".@$this->estimateAmount("USD", $currency2->name, $currency2->units, env("MAX_EXCHANGE_AMOUNT", 50000), $direction->profit_percent)."</amount>"; // РЕЗЕРВ ТИПО
                        $xml .= "<minamount>".@$direction->data['min_amount']." ".$currency->name."</minamount>";
                        $xml .= "<maxamount>".@$direction->data['max_amount']." ".$currency->name."</maxamount>";
                        // if(in_array($currency->name, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
                        //     $xml .= "<param>verifying, cardverify</param>";
                        // }
                        if(in_array($currency2->name, ["CASHRUB"])){
                            $xml .= "<city>".$citiesForCash[$i]."</city>";
                        }
                        $xml .= "</item>";
                    }
                }
            }

            $xml .= "</rates>";
            return $xml;
        });
    }

    public function getCacheAffiliatesCampaigns($user_id){
        // $request = request();
        return Cache::remember("aff-campaigns-".$user_id, 86400, function() use($user_id){
            return AffiliateCampaign::orderBy("id", "DESC")
                ->where("status", true)
                ->where("user_id", $user_id)
                ->get();
        });
    }

    public function getCacheAffiliatesExchanges($user_id, $page_number = false){
        $request = request();
        return Cache::remember("aff-exchanges-".$request->page."-".$user_id.$page_number, 60, function() use($user_id, $page_number){
            $query = AffiliateExchange::orderBy("id", "DESC")
                ->where("user_id", $user_id);
            if(!$page_number)
                return $query->paginate(10);
            
            return $query->limit(10)->offset(($page_number - 1) * 10)->get();
        });
    }

    public function getCacheAffiliatesBalances($user_id){
        // $request = request();
        return Cache::remember("aff-balances-".$user_id, 60, function() use($user_id){
            return AffiliateBalance::with("getCurrency")->orderBy("id", "DESC")
                ->where("user_id", $user_id)
                ->get();
        });
    }

    public function getCacheAffiliatesWithdraws($user_id, $page_number = false){
        $request = request();
        return Cache::remember("aff-withdraws-".$request->page."-".$user_id."-".$page_number, 60, function() use($user_id, $page_number){
            $query = AffiliateWithdraw::orderBy("id", "DESC")
                ->where("user_id", $user_id);

            if(!$page_number)
                return $query->paginate(10);
        
            return $query->limit(10)->offset(($page_number - 1) * 10)->get();
        });
    }

    public function getCachedSeoData(){
        return Cache::remember("cached-seo-data", 86400, function(){
            $data = ExchangerSettigns::where("key", "seoData")->first();
            if(!$data)
                return [];
            return $data->toArray();
        });
    }

    public function getCachedCurrencyDirectionsFrom() {
        return Cache::remember("cached-directions-currency-from", 300, function(){
            $ids = $this->getCacheDirections()->pluck("currency_from")->toArray();
            return $this->getCacheCurrencies()->reject(function ($currency) use($ids) {
                return !in_array($currency->id, $ids);
            });
        });
    }

    public function getCachedCurrencyDirectionsTo($fromId) {
        return Cache::remember("cached-directions-currency-from-".$fromId, 300, function() use($fromId){
            $ids = $this->getCacheDirections()->pluck("currency_to")->toArray();
            return $this->getCacheCurrencies()->reject(function ($currency) use($ids, $fromId) {
                if(!in_array($currency->id, $ids))
                    return false;

                return $currency->id == $fromId;
            });
        });
    }
}