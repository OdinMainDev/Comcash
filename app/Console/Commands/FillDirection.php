<?php

namespace App\Console\Commands;

use App\Models\Direction;
use Illuminate\Console\Command;

class FillDirection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-direction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencies = FillCurrency::getCurrencies();
        $directions = [];
        $position = 1;
        foreach($currencies as $currency){
            foreach($currencies as $currency2){
                if(in_array($currency['id'], [1, 2, 3, 4]) && in_array($currency2['id'], [1, 2, 3, 4])){
                    continue;
                }
                if(in_array($currency['id'], [7, 8]) && in_array($currency2['id'], [7, 8])){
                    continue;
                }
                if($currency['name'] == $currency2['name']){
                    continue;
                }
                
                $name =  json_decode($currency['data'], true)['titles']['en'];
                $name .= " → ";
                $name .= json_decode($currency2['data'], true)['titles']['en'];
                $merchant_from = 1;
                $merchant_from_type = "garantex";
                // if(in_array($currency['name'], ["BTC", "ETH", "USDTTRC20", "USDTERC20", "DAI"])){
                //     $merchant_from = 1;
                //     $merchant_from_type = "garantex";
                // }
                if(in_array($currency['name'], ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
                    $merchant_from = 4;
                    $merchant_from_type = "aifory";
                }

                $merchant_to = 1;
                $merchant_to_type = "garantex";
                // if(in_array($currency2['name'], ["BTC", "ETH", "USDTTRC20", "USDTERC20", "DAI"])){
                //     $merchant_to = 1;
                //     $merchant_to_type = "garantex";
                // }
                if(in_array($currency2['name'], ["SBERRUB", "TCSBRUB", "CASHRUB", "CARDRUB"])){
                    $merchant_to = 4;
                    $merchant_to_type = "aifory";
                }
                $directions[] = [
                    "name" => $name,
                    "currency_from" => $currency['id'],
                    "currency_to" => $currency2['id'],
                    "merchant_from" => $merchant_from,
                    "merchant_to" => $merchant_to,
                    "merchant_type_from" => $merchant_from_type,
                    "merchant_type_to" => $merchant_to_type,
                    "position" => $position,
                    "status" => true,
                    "profit_percent" => 5.00,
                    "data" => json_encode([

                    ]),
                    "created_at" => now()
                ];
                $position++;
            }
        }

        Direction::truncate();
        Direction::insert($directions);
    }
}
