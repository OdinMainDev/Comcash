<?php

namespace App\Console\Commands;

use App\Http\Traits\Models\HasCache;
use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GarantexPayment extends Command
{
    use HasCache;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:garantex-payment';

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
        $merchants = Merchant::where("type", "garantex")->where("status", true)->get();
        foreach($merchants as $merchant) {
            Exchange::where("status", 0)->where("merchant_from", $merchant->id)->chunk(10, function($exchanges) use($merchant){
                $handler = new Handler("garantex", false, $merchant, $exchanges[0]);
                $deposits_resp = $handler->getDeposits();
                if(!$deposits_resp){
                    sendTelegramNotification("ОШИБКА ГАРАНТЕКСА, ОТКЛЮЧЕН МЕРЧАНТ");
                    $merchant->status = false;
                    $merchant->save();
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
                    $address = $exchange->data['merchant_from_data']['address'];
                    $total_amount = 0;
                    foreach($deposits_resp as $row){
                        if($row['state'] != "accepted"){
                            continue;
                        }
                        if($row['address'] != $address){
                            continue;
                        }
                        $total_amount += $row['amount'];
                    }

                    if($total_amount == 0) {
                        continue;
                    }

                    if($total_amount > 0 && $total_amount < $exchange->data['amount_data']['amount_send']){
                        $exchange = $this->recalculateExchange($exchange, $total_amount);
                    }else{
                        // $exchange->status = 1;
                        // $exchange->save();
                    }

                    $text = "🟢<b>ЗАЯВКА ОПЛАЧЕНА ( GARANTEX )</b>🟢\n";
                    $text .= "ID: ".$exchange->id."\n";
                    $text .= "Направление обмена ".$exchange->currencyFrom->name." -> ".$exchange->currencyTo->name."\n";
                    $text .= "Сумма: ". @$exchange->data['amount_data']['amount_send']." -> ". @$exchange->data['amount_data']['amount_receive']."\n";
                    $text .= "Курс обмена:". @$exchange->data['amount_data']['exchange_rate']."\n";
                    $text .= "Дата создания: ".$exchange->created_at."\n\n";
                    if($exchange->data['recalculate']['has_recalculation']){
                        $text .= "⚠️⚠️<b>ЗАЯВКА БЫЛА ПЕРЕРАСЧИТАНА</b>⚠️⚠️\n";
                        $text .= "Предыдущая сумма: ". @$exchange->data['recalculate']['old_amount_send']." -> ". @$exchange->data['recalculate']['old_amount_receive']."\n";
                        $text .= "Предыдущий курс обмена: ". @$exchange->data['recalculate']['old_exchange_rate'];
                    }
                    sendTelegramNotification($text);
                    // тут торговое действие 
                }
                
            });
        }
    }
}
