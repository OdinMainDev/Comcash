<?php

namespace App\Console\Commands;

use App\Models\Exchange;
use Illuminate\Console\Command;

class ClearExchanges extends Command
{
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
                $text = "❌❌❌<b>ЗАЯВКА УДАЛЕНА</b>❌❌❌\n";
                $text .= "ID: ".$exchange->id."\n";
                $text .= "Направление обмена ".$exchange->currencyFrom->name." -> ".$exchange->currencyTo->name."\n";
                $text .= "Сумма: ". @$exchange->data['amount_data']['amount_send']." -> ". @$exchange->data['amount_data']['amount_receive']."\n";
                $text .= "Курс обмена:". @$exchange->data['amount_data']['exchange_rate']."\n";
                $text .= "Дата создания: ".$exchange->created_at."\n\n";

                sendTelegramNotification($text);
            }
        });
    }
}
