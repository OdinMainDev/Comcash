<?php

namespace App\Console\Commands;

use App\Lib\BestChange\BestChange;
use App\Models\Currency;
use App\Models\ExchangeRate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class ParserBestchange extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parser-bestchange';
    protected $description = 'BestchangeParser';

    public function handle(){
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ini_set('memory_limit', '-1');
        try {
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
                if(in_array($name, ["USDTTRC20", "USDTERC20", "USDTTRC20"])){
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
                if(!in_array($name, $request_currency))
                    $request_currency[] = $name;
            }
            $find_currencies = [];
            $bestchange = new BestChange();
            $bestchangeCurrencies = $bestchange->getCurrencies();
            foreach($bestchangeCurrencies as $key => $currencyData){
                foreach($request_currency as $req_currency) {
                    if($req_currency == "USD" || $req_currency == "USDT") {
                        if($currencyData["code"] == "USDTTRC20") {
                            $find_currencies[$req_currency] = $currencyData;
                        }
                    }
                    if($req_currency == "RUB") {
                        if($currencyData["code"] == "TCSBRUB") {
                            $find_currencies[$req_currency] = $currencyData;
                        }
                    }

                    if($req_currency == $currencyData["code"]) {
                        $find_currencies[$req_currency] = $currencyData;
                    }
                }
            }
            unset($bestchangeCurrencies);
            $inserts = [];
            foreach($find_currencies as $currencyCode => $currency) {
                foreach($find_currencies as $currencyCode2 => $currency2) {
                    if($currencyCode == $currencyCode2) continue;
                    $rates = $bestchange->getRatesFilter($currency2['id'], $currency['id']);
                    if(count($rates) == 0) {
                        sendTelegramNotification("<b>ОШИБКА!</b>\nВАЛЮТА НЕ НАЙДЕНА В БЕСТЧЕНЖ ДЛЯ ПАРСИНГА.\n".$currency2['name']." -> ".$currency['name']);
                        continue;
                    }
                    foreach($rates as $key => $value){
                        $inserts[] = [
                            "from" => $currencyCode,
                            "to" => $currencyCode2,
                            "rate" => (float)$value['rate'],
                        ];
                        break;
                    }
                    
                }
            }

            ExchangeRate::truncate();
            ExchangeRate::insert($inserts);
            sendTelegramNotification("Курсы успешно обновлены с бестченжа", 4);
        } catch (\Exception $e) {
            // Регистрация ошибки в логе
            Log::error('Error in your scheduled task: ' . $e->getMessage());
        }
        
        // dd($request_currency);
        // $bestchange = new BestChange();
        // $rates = $bestchange->getRatesFilter(105, 10);
        // foreach($rates as $key => $rate) {
        //     dd($key, $rate);
        // }
    }
}
