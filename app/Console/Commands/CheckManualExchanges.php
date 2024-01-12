<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Models\Exchange;
use Illuminate\Console\Command;

class CheckManualExchanges extends Command
{
    use HasTelegramMessage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-manual-exchanges';

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
        Exchange::whereIn("status", [0, 1, 4]) ->where(function($query){
            $query->whereIn('merchant_type_from', ["manualcrypto", "manualfiat"]);
            $query->orWhereIn('merchant_type_to', ["manualcrypto", "manualfiat"]);
        })
        ->where("created_at", "<", now()->subMinutes(1))->chunk(10, function($exchanges) {
            foreach($exchanges as $exchange){
                $status = "НЕ ОПЛАЧЕНО";
                if($exchange->status == 1){
                    $status = "ОПЛАЧЕНО";
                }
                if($exchange->status == 4){
                    $status = "ВЫПЛАТА В ПРОЦЕССЕ";
                }
                $text = "⚠️⚠️<b>ПРОВЕРЬТЕ РУЧНУЮ ЗАЯВКУ ( СТАТУС ".$status." )</b>⚠️⚠️\n".$this->tgBasicMessage($exchange);

                sendTelegramNotification($text);
            }
        });
    }
}
