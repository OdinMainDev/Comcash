<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Models\Exchange;
use Illuminate\Console\Command;

class ClearExchanges extends Command
{
    use HasTelegramMessage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-exchanges';

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
        Exchange::where("status", 0)->where("created_at", "<", now()->subMinutes(30))->chunk(10, function($exchanges) {
            foreach($exchanges as $exchange){
                $exchange->status = 13;
                $exchange->save();
                $text = "❌❌❌<b>ЗАЯВКА УДАЛЕНА</b>❌❌❌\n".$this->tgBasicMessage($exchange);

                sendTelegramNotification($text);
            }
        });
    }
}
