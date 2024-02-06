<?php

namespace App\Console\Commands;

use App\Http\Traits\Models\HasCache;
use App\Models\Direction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheDirections extends Command
{
    use HasCache;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cache-directions';

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
        Cache::rememberForever("directions-public", function(){
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

                $minAmount = env("MIN_EXCHANGE_AMOUNT", 50);
                $maxAmount = env("MAX_EXCHANGE_AMOUNT", 50);
                if(isset($data['min_amount_usd']) && $data['min_amount_usd'] && $data['min_amount_usd'] > 0){
                    $minAmount = $data['min_amount_usd'];
                }
                if(isset($data['max_amount_usd']) && $data['max_amount_usd'] && $data['max_amount_usd'] > 0){
                    $maxAmount = $data['max_amount_usd'];
                }
                $data['min_amount'] = $this->estimateAmount("USD", $currency_from, $units, $minAmount, $direction->profit_percent);
                $data['max_amount'] = $this->estimateAmount("USD", $currency_from, $units, $maxAmount, $direction->profit_percent);

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
}
