<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RatesParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
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
        $currencies = Currency::get();
        if(count($currencies) == 0){
            return;
        }

        $request_currency = [];
        foreach($currencies as $currency){
            $request_currency[] = $currency['name'];
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
                $inserts = [
                    "from" => $from,
                    "to" => $to,
                    "rate" => $rate,
                ];
            }
        }
        ExchangeRate::insert($inserts);
        sendTelegramNotification("Курсы успешно обновлены", 4);
    }
}
