<?php

namespace App\Jobs;

use App\Http\Traits\Models\HasCache;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;
use App\Merchants\Handler;

class ExchangeStart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HasCache;

    /**
     * Create a new job instance.
     */

    public $exchange;
    public $user;
    public $exchange_id;
    public $language;
    public function __construct($exchange_id, $language, $user = null)
    {
        $this->exchange_id = $exchange_id;
        $this->language = $language;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Lang::setLocale($this->language);
        $this->exchange = Exchange::where("id", $this->exchange_id)->first();
        if(!$this->exchange){
            return;
        }
        if(!$this->user)
            $this->checkUser($this->exchange->data['request_data']['email']);

        $handler = new Handler($this->exchange->merchant_type_from, false, $this->exchange->merchantFrom, $this->exchange);
        $address = $handler->create_address($this->exchange->currencyFrom->name);
        if(!$address){
            $this->exchange->status = 4;
            $this->exchange->save();
            sendTelegramNotification("ОШИБКА ПРИ ГЕНЕРАЦИИ ПЛАТЕЖА (id: ".$this->exchange->id.")", 0);
            return;
        }
        $data = $this->exchange->data;
        $data['user_id'] = $this->user->id;
        if(!is_array($address)){
            $data['merchant_from_data'] = [
                "address" => $address,
                "url" => null
            ];
        }else{
            $data['merchant_from_data'] = [
                "address" => null,
                "url" => $address['paymentURL'],
                "externalID" => $address['externalID']
            ];
        }
        $this->exchange->data = $data;
        $this->exchange->save();

        // переделать на другое мыло и сверстать их вообще
        // Mail::to($this->user->email)->send(new Register($this->user->id, $this->user->email));

        $text = "🟡<b>Новая заявка на обмен</b>🟡\n";
        $text .= "ID: ".$this->exchange->id."\n";
        $text .= "Направление обмена ".$this->exchange->currencyFrom->name." -> ".$this->exchange->currencyTo->name."\n";
        $text .= "Сумма: ". $data['amount_data']['amount_send']." -> ". $data['amount_data']['amount_receive']."\n";
        $text .= "Курс обмена:". $data['amount_data']['exchange_rate']."\n";
        $text .= "Дата создания: ".$this->exchange->created_at."\n\n";
        // остальные данные добавить сюда так же
        $text .= "<b>Данные пользователя</b>\n";
        if(isset($data['request_data']['from_address'])){
            $text .= "Откуда отправляет (адрес):  ".$data['request_data']['from_address']."\n";
        }
        if(isset($data['request_data']['from_card'])){
            $text .= "Откуда отправляет (карта): ".$data['request_data']['from_card']."\n";
        }
        if(isset($data['request_data']['to_address'])){
            $text .= "Куда получает (адрес):  ".$data['request_data']['to_address']."\n";
        }
        if(isset($data['request_data']['to_card'])){
            $text .= "Куда получает (карта): ".$data['request_data']['to_card']."\n";
        }
        if(isset($data['request_data']['email'])){
            $text .= "Email: ".$data['request_data']['email']."\n";
        }
        if(isset($data['request_data']['phone'])){
            $text .= "Телефон: ".$data['request_data']['phone']."\n";
        }
        if(isset($data['request_data']['telegram'])){
            $text .= "Telegram: ".$data['request_data']['telegram']."\n";
        }
        if(isset($data['request_data']['first_name'])){
            $text .= "Имя: ".$data['request_data']['first_name']."\n";
        }
        if(isset($data['request_data']['second_name'])){
            $text .= "Отчество: ".$data['request_data']['second_name']."\n";
        }
        if(isset($data['request_data']['last_name'])){
            $text .= "Фамилия: ".$data['request_data']['last_name']."\n";
        }
        if(isset($data['request_data']['passport'])){
            $text .= "Паспорт: ".$data['request_data']['passport']."\n";
        }



        $text .= "\n";
        if($this->user->first_name)
            $text .= "Имя (привязанное к аккаунту): ".$this->user->first_name."\n";
        if($this->user->second_name)
            $text .= "Отчество (привязанное к аккаунту): ".$this->user->second_name."\n";
        if($this->user->last_name)
            $text .= "Фамилия (привязанная к аккаунту): ".$this->user->last_name."\n";
        $text .= "Email (привязанный к аккаунту): ".$this->user->email."\n";
        
        
        sendTelegramNotification($text);
    }

    public function checkUser($user_email){
        $user = User::where("email", $user_email)->first();
        if($user){
           $this->user = $user;
           $this->exchange->user_id = $user->id;
           return; 
        }

        $password = generateRandomString();
        $user = new User;
        $user->email = $user_email;
        $user->password = Hash::make($password);
        $user->save();
        $this->user = $user;
        Mail::to($this->user->email)->send(new Register($this->user->id, $this->user->email, $password));
    }
}
