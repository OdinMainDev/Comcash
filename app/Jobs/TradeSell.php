<?php

namespace App\Jobs;

use App\Merchants\Handler;
use App\Models\Exchange;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TradeSell implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $exchange_id;
    public $exchange;

    public function __construct($exchange_id)
    {
        $this->exchange_id = $exchange_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->exchange = Exchange::where("status", 1)->where("id", $this->exchange_id)->first();
        if(!$this->exchange)
            return;
        $handler = new Handler($this->exchange->merchant_type_from, false, $this->exchange->merchantFrom, $this->exchange);
        $response = $handler->sellCurrency($this->exchange->merchantFrom, $this->exchange);
        $text = "🟢🟢<b>ПРОДАЖА ВАЛЮТЫ (ТОРГОВОЕ ДЕЙСТВИЕ)</b>🟢🟢\n";
        $text .= "ID: ".$this->exchange->id."\n";
        $text .= "Направление обмена ".$this->exchange->currencyFrom->name." -> ".$this->exchange->currencyTo->name."\n";
        $text .= "Сумма: ". @$this->exchange->data['amount_data']['amount_send']." -> ". @$this->exchange->data['amount_data']['amount_receive']."\n";
        $text .= "Курс обмена:". @$this->exchange->data['amount_data']['exchange_rate']."\n";
        $text .= "Дата создания: ".$this->exchange->created_at."\n\n";
        if(isset($response['error']) && is_array($response['error'])){
            $text .= "⚠️⚠️<b>ТОРГОВОЕ ДЕЙСТВИЕ С ОШИБКОЙ ЗАВЕРШЕНО</b>⚠️⚠️\n";
            $text .= "Код ошибки: ".$response['error']['code']."\n";
            $text .= "Сообщение: ".$response['error']['message']."\n";
        }
        sendTelegramNotification($text);
        $this->exchange->status = 2;
        $this->exchange->save();

        TradeBuy::dispatch($this->exchange_id);
    }
}
