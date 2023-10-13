<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasAmount;
use App\Models\Currency;
use App\Models\ExchangeRate;
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
    public function handle()
    {
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

        $request_currency = implode(",", $request_currency);
        $api_key = env("CRYPTOCOMPARE_KEY", false);
        if(!$api_key){
            sendTelegramNotification("<b>ОШИБКА!</b>\nНастройте парсер.");
        }
        $url = "https://min-api.cryptocompare.com/data/pricemulti?api_key=$api_key&fsyms=$request_currency&tsyms=$request_currency";
        $response = Http::get($url);
        if($response->clientError() || $response->status() != 200){
            sendTelegramNotification("<b>ОШИБКА!</b>\nОшибка при парсинге курсов, кривой ответ от сервера курсов валют.");
        }      
        $response = $response->json();
        ExchangeRate::truncate();
        $inserts = [];
        foreach($response as $from => $arr){
            foreach($arr as $to => $rate){
                if($from == $to){
                    continue;
                }
                $inserts[] = [
                    "from" => $from,
                    "to" => $to,
                    "rate" => (float)$rate,
                ];
            }
        }
        ExchangeRate::insert($inserts);
        sendTelegramNotification("Курсы успешно обновлены", 4);
    }
}
