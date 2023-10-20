<?php

namespace App\Console\Commands;

use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GarantexWithdraw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:garantex-withdraw';

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
            Exchange::where("status", 4)->where("merchant_to", $merchant->id)->chunk(10, function($exchanges) use($merchant){
                $handler = new Handler("garantex", false, $merchant, $exchanges[0]);
                $withdraws_resp = $handler->getWithdraws();
                if(!$withdraws_resp){
                    sendTelegramNotification("ОШИБКА ГАРАНТЕКСА, ОТКЛЮЧЕН МЕРЧАНТ");
                    $merchant->status = false;
                    $merchant->save();
                    Artisan::call('cache:clear');
                    return;
                }
                foreach($exchanges as $exchange){
                    $address = mb_strtolower($exchange->data['request_data']['to_address']);
                    $check = false;
                    foreach($withdraws_resp as $row){
                        if(!isset($row['rid'])){
                            continue;
                        }
                        if(mb_strtolower($row['rid']) != $address){
                            continue;
                        }
                        if($row['state'] != "succeed"){
                            continue;
                        }
                        
                        $check = true;
                    }

                    if(!$check) {
                        continue;
                    }

                    $exchange->status = 5;
                    $exchange->save();

                    $text = "✅✅✅<b>ЗАЯВКА ЗАВЕРШЕНА ( GARANTEX )</b>✅✅✅\n";
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
                    
                }
                
            });
        }
    }
}
