<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasAmount;
use App\Http\Traits\Models\HasCache;
use App\Lib\ParserV2\Parser;
use App\Models\Currency;
use App\Models\ExchangeRate;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RatesParser extends Command{
    
    use HasAmount, HasCache;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    // php artisan app:rates-parser
    protected $signature = 'app:rates-parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto parse all exchange rates';

    /**
     * Execute the console command.
     */
    public function handle(){
        $currencies = Currency::where("status", true)->get();
        if(count($currencies) == 0){
            return;
        }

        $request_currency = ["USD", "USDT", "RUB", "EUR"];
        foreach($currencies as $currency){
            $name = $currency->name;
            if(in_array($name, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB", "SBPRUB", "ACCRUB"])){
                $name = "RUB";
            }
            if(in_array($name, ["USDTTRC20", "USDTERC20", "USDTBEP20", "USDCERC20", "USDCSOL"])){
                $name = "USDT";
            }
            if(in_array($name, ["TONCOIN"])){
                $name = "TON";
            }
            if(in_array($name, ["CARDUSD", "CASHUSD"])){
                $name = "USD";
            }
            if(in_array($name, ["CASHEUR"])){
                $name = "EUR";
            }
            if(in_array($name, ["BNBBEP20"])){
                $name = "BNB";
            }
            if(!in_array($name, $request_currency))
                $request_currency[] = $name;
        }
        $inserts = [];
        // $inserts = array_merge($inserts, $this->parseFromGarantex());
        $inserts = array_merge($inserts, $this->parseFromParserV3($request_currency, count($inserts) == 0));
        if(count($inserts) == 0){
                sendTelegramNotification("ОШИБКА ПАРСЕРА 3 !!", 4);
            $inserts = array_merge($inserts, $this->parseFromGarantex());
            if(count($inserts) == 0){
                sendTelegramNotification("ОШИБКА ПАРСЕРА 2 !!", 4);
            }
            return;
            sendTelegramNotification("ОШИБКА НОВОГО ПАРСЕРА 1 !!");
            $inserts = array_merge($inserts, $this->parseFromCryptocompare($request_currency, count($inserts) == 0));
        }
        
        ExchangeRate::truncate();
        ExchangeRate::insert($inserts);
        $this->refreshCacheExportJson();
        $this->refreshCacheExportXml();
        sendTelegramNotification("Курсы успешно обновлены", 4);
    }

    public function parseFromCryptocompare($request_currency, $without_garantex_rates = false) {
        $request_currency = implode(",", $request_currency);
        $api_key = env("CRYPTOCOMPARE_KEY", false);
        if(!$api_key){
            sendTelegramNotification("<b>ОШИБКА!</b>\nНастройте парсер.", 4);
            return [];
        }
        $url = "https://min-api.cryptocompare.com/data/pricemulti?api_key=$api_key&fsyms=$request_currency&tsyms=$request_currency";
        $response = Http::get($url);
        if($response->clientError() || $response->status() != 200){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов, кривой ответ от сервера курсов валют.", 4);
            return [];
        }

        $response = $response->json();
        $inserts = [];
        if(@$response['Response'] == "Error"){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов 2, кривой ответ от сервера курсов валют.\n\n".json_encode($response), 4);
            return [];
        }

        
        foreach($response as $from => $arr){
            foreach($arr as $to => $rate){
                if($from == $to){
                    continue;
                }

                if($without_garantex_rates){
                    if(in_array($from, ["BTC", "ETH", "USDT", "DAI"])){
                        if(in_array($from, ["USD", "RUB"])){
                            continue;
                        }
                    }
                }
                $inserts[] = [
                    "from" => $from,
                    "to" => $to,
                    "rate" => (float)$rate,
                ];
            }
        }

        return $inserts;
    }

    public function parseFromGarantex() {
        $currencies = ["BTC", "ETH", "USDT", "DAI"];
        $currencies2 = ["RUB", "USD"];
        $inserts = [];
        foreach($currencies as $currency){
            foreach($currencies2 as $currency2){
                $url = "https://garantex.org/api/v2/trades?market=".mb_strtolower($currency).mb_strtolower($currency2);
                try {
                    $response = Http::timeout(-1)->get($url);
                    if($response->clientError() || $response->status() != 200){
                        sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса, кривой ответ от сервера курсов валют.", 4);
                        return [];
                    }
                    $response = $response->json();
                    if(!is_array($response) || count($response) == 0){
                        sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 2, кривой ответ от сервера курсов валют.", 4);
                        return [];
                    }
                    $inserts[] = [
                        "from" => $currency,
                        "to" => $currency2,
                        "rate" => $response[0]['price'],
                    ];
                } catch (RequestException $ex){
                    sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 3, кривой ответ от сервера курсов валют.\n\n".$ex->getMessage(), 4);
                    return [];
                }
                
            }
        }

        return $inserts;
    }

    public function parseFromParserV2($request_currency, $without_garantex_rates = false) {
        $parser = new Parser($request_currency);
        $response = $parser->handle();
        $inserts = [];
        if(!is_array($response)){
            return $inserts;
        }
        foreach($response as $from => $arr){
            foreach($arr as $to => $rate){
                if($from == $to){
                    continue;
                }

                if($without_garantex_rates){
                    if(in_array($from, ["BTC", "ETH", "USDT", "DAI"])){
                        if(in_array($from, ["USD", "RUB"])){
                            continue;
                        }
                    }
                }
                $inserts[] = [
                    "from" => $from,
                    "to" => $to,
                    "rate" => (float)$rate,
                ];
            }
        }

        return $inserts;
    }


    public function parseFromParserV3($request_currency, $without_garantex_rates = false) {
        $parser = new Parser($request_currency);
        $response = $parser->getV3Data();
        if(!$response) {
            return [];
        }
        $response = json_decode($response);
        if(!$response) {
            return [];
        }
        $inserts = [];

        $url = "https://compay.one/get-rates?apiKey=szxzLzUB6hvL2eJLBjqr5Qeeu5d7hAN1";
        $response = Http::get($url);
        if($response->clientError() || $response->status() != 200){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов, кривой ответ от сервера курсов валют.", 4);
            return [];
        }
        $inserts = [];
        if(!isset($response['data']) || !is_array($response['data'])){
            return $inserts;
        }
        foreach($response['data'] as $from => $arr){
            foreach($arr as $to => $rate){
                if($from == $to){
                    continue;
                }

                if($without_garantex_rates){
                    if(in_array($from, ["BTC", "ETH", "USDT", "DAI"])){
                        if(in_array($from, ["USD", "RUB"])){
                            continue;
                        }
                    }
                }
                $inserts[] = [
                    "from" => $from,
                    "to" => $to,
                    "rate" => (float)$rate,
                ];
            }
        }

        return $inserts;
    }
}