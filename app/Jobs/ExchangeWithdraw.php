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

class ExchangeWithdraw implements ShouldQueue
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
        $this->exchange = Exchange::where("status", 3)->where("id", $this->exchange_id)->first();
        if(!$this->exchange)
            return;
        $handler = new Handler($this->exchange->merchant_type_to, false, $this->exchange->merchantTo, $this->exchange);
        $response = $handler->makeWithdraw($this->exchange->merchantTo, $this->exchange);
        $text = "🟢🟢<b>ВЫПЛАТА НАЧАТА</b>🟢🟢\n";
        $text .= "ID: ".$this->exchange->id."\n";
        $text .= "Направление обмена ".$this->exchange->currencyFrom->name." -> ".$this->exchange->currencyTo->name."\n";
        $text .= "Сумма: ". @$this->exchange->data['amount_data']['amount_send']." -> ". @$this->exchange->data['amount_data']['amount_receive']."\n";
        $text .= "Курс обмена:". @$this->exchange->data['amount_data']['exchange_rate']."\n";
        $text .= "Дата создания: ".$this->exchange->created_at."\n\n";
        if(isset($response['error']) && is_array($response['error'])){
            $text = "⚠️⚠️<b>ВЫПЛАТА НАЧАТА ОШИБКОЙ</b>⚠️⚠️\n";
            $text .= "ID: ".$this->exchange->id."\n";
            $text .= "Направление обмена ".$this->exchange->currencyFrom->name." -> ".$this->exchange->currencyTo->name."\n";
            $text .= "Сумма: ". @$this->exchange->data['amount_data']['amount_send']." -> ". @$this->exchange->data['amount_data']['amount_receive']."\n";
            $text .= "Курс обмена:". @$this->exchange->data['amount_data']['exchange_rate']."\n";
            $text .= "Дата создания: ".$this->exchange->created_at."\n\n";
            $text .= "Код ошибки: ".@$response['error']['code']."\n";
            $text .= "Сообщение: ".@$response['error']['message']."\n";
            $text .= "⚠️⚠️<b>ДАННУЮ ЗАЯВКУ НУЖНО ЗАКРЫТЬ ВРУЧНУЮ</b>⚠️⚠️\n";
            $this->exchange->status = 15;
            $this->exchange->save();
        }else{
            $data = $this->exchange->data;
            $data['merchant_to_data'] = $response;
            $this->exchange->data = $data;
            $this->exchange->status = 4;
            $this->exchange->save();
        }
        sendTelegramNotification($text);
    }
}
