<?php

namespace App\Console\Commands;

use App\Http\Traits\Models\HasCache;
use App\Http\Traits\Models\HasLogs;
use App\Jobs\TradeSell;
use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;


class AiforyPayment extends Command
{
    use HasCache, HasLogs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:aifory-payment';

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
        $merchants = Merchant::where("type", "aifory")->where("status", true)->get();
        foreach($merchants as $merchant) {
            Exchange::where("status", 0)->where("merchant_from", $merchant->id)->chunk(10, function($exchanges) use($merchant){
                foreach($exchanges as $exchange){
                    if(!@$exchange->data['merchant_from_data']['orderID']){
                        continue;
                    }
                    $handler = new Handler("aifory", false, $merchant, $exchange);
                    $deposits_resp = $handler->getDeposits();
                    if(!$deposits_resp){
                        sendTelegramNotification("ОШИБКА aifory ПРИ ПЛАТЕЖЕ");
                        return;
                    }
                    if(!isset($exchange->data['merchant_from_data']['orderID'])){
                        continue;
                    }

                    $total_amount = 0;
                    if(!@$deposits_resp['successPaid'] || @$deposits_resp['successPaid'] <= 0){
                        continue;
                    }
                    $total_amount += $deposits_resp['successPaid'];
                    if($total_amount == 0) {
                        continue;
                    }

                    if($total_amount > 0 && $total_amount < $exchange->data['amount_data']['amount_send']){
                        $exchange = $this->recalculateExchange($exchange, $total_amount);
                    }else{
                        $exchange->status = 1;
                        $exchange->save();
                    }

                    $text = "🟢<b>ЗАЯВКА ОПЛАЧЕНА ( aifory )</b>🟢\n";
                    $text .= "ID: ".$exchange->id."\n";
                    $text .= "Направление обмена ".$exchange->currencyFrom->name." -> ".$exchange->currencyTo->name."\n";
                    $text .= "Сумма: ". @$exchange->data['amount_data']['amount_send']." -> ". @$exchange->data['amount_data']['amount_receive']."\n";
                    $text .= "Курс обмена:". @$exchange->data['amount_data']['exchange_rate']."\n";
                    $text .= "Дата создания: ".$exchange->created_at."\n\n";
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
