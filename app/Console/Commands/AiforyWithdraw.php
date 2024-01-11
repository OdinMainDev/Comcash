<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Merchants\Handler;
use App\Models\Exchange;
use App\Models\Merchant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AiforyWithdraw extends Command
{
    use HasTelegramMessage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:aifory-withdraw';

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
            Exchange::where("status", 4)->where("merchant_to", $merchant->id)->chunk(10, function($exchanges) use($merchant){
                foreach($exchanges as $exchange){
                    $handler = new Handler("aifory", false, $merchant, $exchange);
                    $withdraw_resp = $handler->getWithdraws();
                    if(!$withdraw_resp){
                        sendTelegramNotification("ОШИБКА aifory, ОТКЛЮЧЕН МЕРЧАНТ");
                        $merchant->status = false;
                        $merchant->save();
                        Artisan::call('cache:clear');
                        return;
                    }
                    if(!@$withdraw_resp['successPaid'] || @$withdraw_resp['successPaid'] <= 0){
                        continue;
                    }
                    
                    $exchange->status = 5;
                    $exchange->save();

                    $text = "✅✅✅<b>ЗАЯВКА ЗАВЕРШЕНА ( aifory )</b>✅✅✅\n".$this->tgBasicMessage($exchange);
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
