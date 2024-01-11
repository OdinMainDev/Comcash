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
        Exchange::where("status", 0) ->where(function($query){
            $query->whereIn('merchant_type_from', ["manualcrypto", "manualfiat"]);
            $query->orWhereIn('merchant_type_to', ["manualcrypto", "manualfiat"]);
        })
        ->where("created_at", "<", now()->subMinutes(1))->chunk(10, function($exchanges) {
            foreach($exchanges as $exchange){
                $text = "⚠️⚠️<b>ПРОВЕРЬТЕ РУЧНУЮ ЗАЯВКУ ( СТАТУС НЕ ОПЛАЧЕНО )</b>⚠️⚠️\n".$this->tgBasicMessage($exchange);

                sendTelegramNotification($text);
            }
        });
    }
}
