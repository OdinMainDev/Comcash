<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasAmount;
use App\Models\Currency;
use App\Models\ExchangeRate;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RatesParser extends Command{
    
    use HasAmount;
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

        $request_currency = ["USD", "USDT", "RUB"];
        foreach($currencies as $currency){
            $name = $currency->name;
            if(in_array($name, ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
                $name = "RUB";
            }
            if(in_array($name, ["USDTTRC20", "USDTERC20"])){
                $name = "USDT";
            }
            if(!in_array($name, $request_currency))
                $request_currency[] = $name;
        }
        $inserts = [];
        // $inserts = array_merge($inserts, $this->parseFromGarantex());
        $inserts = array_merge($inserts, $this->parseFromCryptocompare($request_currency, count($inserts) == 0));
        
        ExchangeRate::truncate();
        ExchangeRate::insert($inserts);
        sendTelegramNotification("Курсы успешно обновлены", 4);
    }

    public function parseFromCryptocompare($request_currency, $without_garantex_rates = false) {
        $request_currency = implode(",", $request_currency);
        $api_key = env("CRYPTOCOMPARE_KEY", false);
        if(!$api_key){
            sendTelegramNotification("<b>ОШИБКА!</b>\nНастройте парсер.");
            return [];
        }
        $url = "https://min-api.cryptocompare.com/data/pricemulti?api_key=$api_key&fsyms=$request_currency&tsyms=$request_currency";
        $response = Http::get($url);
        if($response->clientError() || $response->status() != 200){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов, кривой ответ от сервера курсов валют.");
            return [];
        }

        $response = $response->json();
        $inserts = [];
        if(@$response['Response'] == "Error"){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов 2, кривой ответ от сервера курсов валют.\n\n".json_encode($response));
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
                        sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса, кривой ответ от сервера курсов валют.");
                        return [];
                    }
                    $response = $response->json();
                    if(!is_array($response) || count($response) == 0){
                        sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 2, кривой ответ от сервера курсов валют.");
                        return [];
                    }
                    $inserts[] = [
                        "from" => $currency,
                        "to" => $currency2,
                        "rate" => $response[0]['price'],
                    ];
                } catch (RequestException $ex){
                    sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 3, кривой ответ от сервера курсов валют.\n\n".$ex->getMessage());
                    return [];
                }
                
            }
        }

        return $inserts;
    }

    // public function parseFromGarantex() {
    //     $response = $this->getRequest("https://garantex.org/rates");
    //     if(!$response){
    //         sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса, кривой ответ от сервера курсов валют.");
    //         return [];
    //     }
    //     $jsonResponse = @json_decode($response, true);
    //     if(!$jsonResponse){
    //         sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса, кривой ответ от сервера курсов валют 2.\n".$response);
    //         return [];
    //     }
    //     $inserts = [];
    //     $currencies = ["BTC", "ETH", "USDT", "DAI"];
    //     $currencies2 = ["RUB", "USD"];
    //     foreach($jsonResponse as $key => $value){
    //         foreach($currencies as $currency){
    //             foreach($currencies2 as $currency2){
    //                 $currency = mb_strtolower($currency);
    //                 $currency2 = mb_strtolower($currency2);
    //             }
    //         }
    //         $inserts[] = [
    //             "from" => $currency,
    //             "to" => $currency2,
    //             "rate" => $response[0]['price'],
    //         ];
    //     }

    //     dd(count($inserts));
    //     if(count($inserts) != 8) {

    //     }


    //     $currencies = ["BTC", "ETH", "USDT", "DAI"];
    //     $currencies2 = ["RUB", "USD"];
    //     $inserts = [];
    //     $url = "https://garantex.org/rates";
    //     try {
    //         $response = Http::timeout(-1)->get($url);
    //         if($response->clientError() || $response->status() != 200){
    //             sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса, кривой ответ от сервера курсов валют.");
    //             return [];
    //         }
    //         $response = $response->json();
    //         if(!is_array($response) || count($response) == 0){
    //             sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 2, кривой ответ от сервера курсов валют.");
    //             return [];
    //         }
    //         dd($response);
    //         $inserts[] = [
    //             "from" => $currency,
    //             "to" => $currency2,
    //             "rate" => $response[0]['price'],
    //         ];
    //     } catch (RequestException $ex){
    //         sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов гарантекса 3, кривой ответ от сервера курсов валют.\n\n".$ex->getMessage());
    //         return [];
    //     }

    //     foreach($currencies as $currency){
    //         foreach($currencies2 as $currency2){
                
                
    //         }
    //     }

    //     return $inserts;
    // }

    // public function getRequest($url) {
    //     $options = array(
    //         CURLOPT_TIMEOUT => 5,
    //         CURLOPT_CONNECTTIMEOUT => 5,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_MAXREDIRS => 2,
    //         CURLOPT_SSL_VERIFYPEER => 0,
    //         CURLOPT_SSL_VERIFYHOST => 0,
    //         CURLOPT_HTTPHEADER => array(
    //             'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
    //             'Cache-Control: no-cache',
    //             'Pragma: no-cache'
    //         ),
    //     );
    //     $ch = curl_init();
    //     $curl_options = array(
    //         CURLOPT_URL => $url,
    //         CURLOPT_RETURNTRANSFER => 1,
    //         CURLOPT_SSL_VERIFYPEER => false,
    //         CURLOPT_SSL_VERIFYHOST => false,
    //         CURLOPT_REFERER => '',
    //         CURLOPT_TIMEOUT => 20,
    //         CURLOPT_CONNECTTIMEOUT => 20,
    //         CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.86 Safari/537.36 OPR/60.0.3255.27",
    //     );
    //     foreach($options as $k => $v){
    //         $curl_options[$k] = $v;
    //     }
    //     curl_setopt_array($ch, $curl_options);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     return $response;
    // }
}
