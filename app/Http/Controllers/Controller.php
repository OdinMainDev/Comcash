<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
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

        if(!$request->amount) {
            if(!isset($direction->data['min_amount'])){
                throw ValidationException::withMessages(["currency" => "bad amount ( required from request )"]);
            }
            $request->amount = $direction->data['min_amount'];
        }
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $units, $request->amount, $direction->profit_percent, $request->reverse);
        if(!$amount){
            throw ValidationException::withMessages(["currency" => "bad amount"]);
        }
        return [
            "amount_from" => $request->amount,
            "amount" => $amount,
            "direction" => $direction,
            "currency_from" => $currency_from,
            "currency_to" => $currency_to,
        ];
    }

    public function getRealCurrencyCode($currency_code){
        return $this->convertCurrencyName($currency_code);
    }

    public function isRootUser() {
        return auth()->user()->isRootAdmin();
    }

    public function setSeoData($seo_data, $page_data = []) {
        SEOTools::setTitle($seo_data['title']);
        SEOTools::setDescription($seo_data['description']);
        SEOMeta::addKeyword($seo_data['keywords']);
        SEOTools::opengraph()->setUrl(route("index")); // STATIC
        if(count($page_data) == 0)
            SEOTools::setCanonical(route($seo_data['page']));
        else
            SEOTools::setCanonical(route($seo_data['page'], $page_data));
        // SEOTools::opengraph()->addProperty('type', 'articles');
        // SEOTools::twitter()->setSite('@LuizVinicius73');
        // SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');
    }

    public function constructSeoData($page, $pagename, $data) {
        if(count($data) == 0 || !isset($data['value'])){
            return [
                "page" => $page,
                "title" => ucfirst($this->theme),
                "description" => ucfirst($this->theme),
                "keywords" => [ucfirst($this->theme)]
            ];
        }
        $data = json_decode($data['value'], true);
        if(!isset($data[$pagename])){
            return [
                "page" => $page,
                "title" => ucfirst($this->theme),
                "description" => ucfirst($this->theme),
                "keywords" => [ucfirst($this->theme)]
            ];
        }
        $data = $data[$pagename];
        $lang = mb_strtolower(app()->getLocale());
        return [
            "page" => $page,
            "title" => $data['titles'][$lang],
            "description" => $data['titles'][$lang],
            "keywords" => explode(",", str_replace(' ', '',$data['titles'][$lang]))
        ];
    }
}
