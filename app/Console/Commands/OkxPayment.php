<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasCache;
use App\Http\Traits\Models\HasLogs;
use App\Jobs\TradeSell;
use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class OkxPayment extends Command
{
    use HasCache, HasLogs, HasTelegramMessage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:okx-payment';

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
        $merchants = Merchant::where("type", "okx")->where("status", true)->get();
        foreach($merchants as $merchant) {
            Exchange::where("status", 0)->where("merchant_from", $merchant->id)->chunk(10, function($exchanges) use($merchant){
                $handler = new Handler("okx", false, $merchant, $exchanges[0]);
                $deposits_resp = $handler->getDeposits();
                if(!$deposits_resp){
                    sendTelegramNotification("ОШИБКА OKX, ПРИ ПОПЫТКЕ ПОЛУЧИТЬ ДЕПОЗИТЫ");
                    Artisan::call('cache:clear');
                    return;
                }
                
                foreach($exchanges as $exchange){
                    if(!isset($exchange->data['merchant_from_data']['address'])){
                        continue;
                    }
                    if(empty($exchange->data['merchant_from_data']['address'])){
                        continue;
                    }
                    $address = mb_strtolower($exchange->data['merchant_from_data']['address']);
                    $total_amount = 0;
                    foreach($deposits_resp as $row){
                        if(@$row['info']['state'] != "2"){
                            continue;
                        }
                        if(mb_strtolower($row['address']) != $address){
                            continue;
                        }
                        $total_amount += $row['amount'];
                    }

                    if($total_amount <= 0) {
                        continue;
                    }

                    if($total_amount < $exchange->data['amount_data']['amount_send']){
                        $exchange = $this->recalculateExchange($exchange, $total_amount);
                    }else{
                        $exchange->status = 1;
                        $exchange->save();
                    }

                    $text = "🟢<b>ЗАЯВКА ОПЛАЧЕНА ( OKX )</b>🟢\n".$this->tgBasicMessage($exchange);
                    if($exchange->data['recalculate']['has_recalculation']){
                        $text .= "⚠️⚠️<b>ЗАЯВКА БЫЛА ПЕРЕРАСЧИТАНА</b>⚠️⚠️\n";
                        $text .= "Предыдущая сумма: ". @$exchange->data['recalculate']['old_amount_send']." -> ". @$exchange->data['recalculate']['old_amount_receive']."\n";
                        $text .= "Предыдущий курс обмена: ". @$exchange->data['recalculate']['old_exchange_rate'];
                        if($exchange->status == 14){
                            $text .= "⚠️⚠️<b>ВНИМАНИЕ ЗАЯВКУ НУЖНО ВРУЧНУЮ ОБРАБОТАТЬ</b>⚠️⚠️\n";
                        }
                    }
                    sendTelegramNotification($text);
                    if($exchange->status == 1){
                        TradeSell::dispatch($exchange->id);
                    }
                }
                
            });
        }
    }
}
