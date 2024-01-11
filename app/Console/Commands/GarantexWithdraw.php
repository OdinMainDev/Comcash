<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GarantexWithdraw extends Command
{
    use HasTelegramMessage;
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
                    sendTelegramNotification("ОШИБКА ГАРАНТЕКСА, ПРИ ПОПЫТКЕ ПОЛУЧИТЬ ВЫПЛАТЫ");
                    Artisan::call('cache:clear');
                    return;
                }
                foreach($exchanges as $exchange){
                    $address = mb_strtolower($exchange->data['request_data']['to_address']);
                    $check = false;
                    $hasError = false;
                    foreach($withdraws_resp as $row){
                        if(!isset($row['rid'])){
                            continue;
                        }
                        if(mb_strtolower($row['rid']) != $address){
                            continue;
                        }
                        if($row['state'] == "rejected"){
                            $hasError = true;
                            break;
                        }
                        if($row['state'] != "succeed"){
                            break;
                        }
                        
                        $check = true;
                        break;
                    }

                    if($hasError){
                        $exchange->status = 15;
                        $exchange->save();
                        $text = "❌❌❌<b>ОШИБКА В ВЫПЛАТЕ ЗАЯВКИ</b>❌❌❌\n".$this->tgBasicMessage($exchange);
                        sendTelegramNotification($text);
                        continue;
                    }

                    if(!$check) {
                        continue;
                    }

                    $exchange->status = 5;
                    $exchange->save();

                    $text = "✅✅✅<b>ЗАЯВКА ЗАВЕРШЕНА ( GARANTEX )</b>✅✅✅\n".$this->tgBasicMessage($exchange);
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
