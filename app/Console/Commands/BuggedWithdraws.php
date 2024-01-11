<?php

namespace App\Console\Commands;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Models\Exchange;
use Illuminate\Console\Command;

class BuggedWithdraws extends Command
{
    use HasTelegramMessage;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bugged-withdraws';

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
        Exchange::where("status", 4)->where("updated_at", "<", now()->subHours(48))->chunk(10, function($exchanges) {
            foreach($exchanges as $exchange){
                $exchange->status = 15;
                $exchange->save();
                $text = "❌❌❌<b>ОШИБКА В ВЫПЛАТЕ ЗАЯВКИ</b>❌❌❌\n".$this->tgBasicMessage($exchange);

                sendTelegramNotification($text);
            }
        });
    }
}
