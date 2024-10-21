<?php

namespace App\Jobs;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasAffiliate;
use App\Http\Traits\Models\HasCache;
use App\Http\Traits\Models\HasUtm;
use App\Mail\ExchangeCreate;
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
use App\Models\UtmParameter;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Mailer\Exception\TransportException;

class ExchangeStart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, HasCache, HasAffiliate, HasTelegramMessage, HasUtm;

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
        $this->exchange = Exchange::with("merchantFrom")->where("id", $this->exchange_id)->first();
        if(!$this->exchange){
            return;
        }
        if(!$this->user){
            $isRegistered = $this->checkUser($this->exchange->data['request_data']['email']);
            if($isRegistered) {
                if(isset($this->exchange->data['request_data']['aff_id'])
                    && is_numeric($this->exchange->data['request_data']['aff_id'])){
                    $this->addUserToAffiliate($this->user, $this->exchange->data['request_data']['aff_id']);
                }
            }
        }

        if(isset($this->exchange->data['request_data']['utm_id'])
            && is_numeric($this->exchange->data['request_data']['utm_id'])){
            $this->addExchangeToUtm($this->exchange, $this->exchange->data['request_data']['utm_id']);
        }

        $this->exchange->user_id = $this->user->id;
        $data = $this->exchange->data;
        $data['user_id'] = $this->user->id;
        $this->exchange->data = $data;
        $handler = new Handler($this->exchange->merchant_type_from, false, $this->exchange->merchantFrom, $this->exchange);
        $address = $handler->create_address($this->exchange->currencyFrom->name);
        if(!$address){
            $this->exchange->status = 11;
            $this->exchange->save();
            sendTelegramNotification("ОШИБКА ПРИ ГЕНЕРАЦИИ ПЛАТЕЖА (id: ".$this->exchange->id.")", 0);
            return;
        }
        $data = $this->exchange->data;
        $data['user_id'] = $this->user->id;
        $isManualMode = false;
        if(!is_array($address)){
            $data['merchant_from_data'] = [
                "address" => $address,
                "url" => null
            ];
        }else{
            if(!@$address['is_manual_mode']){
                $data['merchant_from_data'] = [
                    "address" => null,
                    "url" => $address['paymentURL'],
                    "externalID" => @$address['externalID'],
                    "orderID" => @$address['orderID']
                ];
            }else{
                $isManualMode = true;
                $isCacheMode = @$address['is_cache_mode'];
                $data['merchant_from_data'] = $this->checkAvailWalletForManualExchange($isCacheMode);
                if(!$data['merchant_from_data']['address']) {
                    sendTelegramNotification("❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️\n<b> ЗАКОНЧИЛИСЬ КОШЕЛЬКИ ДЛЯ ВАЛЮТЫ: </b>".$this->exchange->currencyFrom->name, 0);
                    sendTelegramNotification("❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️❗️\n<b> ЗАПОЛНИТЕ КОШЕЛЕК ДЛЯ ОБМЕНА С ID: </b>".$this->exchange->id, 0);
                }
            }
        }
        $this->exchange->data = $data;
        $this->exchange->save();

        // переделать на другое мыло и сверстать их вообще
        // if($this->user->email[0] != "@")
        //     Mail::to($this->user->email)->send(new ExchangeCreate($this->user->id, $this->user->email, $this->exchange));


        $isTelegramBotExchange = false;
        if(isset($this->exchange->data['isTelegramExchange']) && $this->exchange->data['isTelegramExchange']){
            $isTelegramBotExchange = true;
        }
        $text = "";
        if($isManualMode){
            $text = "❗️⚠️⚠️<b>ВНИМАНИЕ ЗАЯВКА ДОЛЖНА БЫТЬ ОТРАБОТАНА В РУЧНОМ РЕЖИМЕ!</b>⚠️⚠️❗️\n";
            if($isCacheMode){
                $text .= "❗️⚠️⚠️<b>ВНИМАНИЕ ЗАЯВКА НА НАЛИЧКУ!</b>⚠️⚠️❗️\n";
            }
            $text .= "\n";
        }
        $text .= "🟡<b>Новая заявка на обмен</b>🟡\n";
        if($isTelegramBotExchange){
            $text .= "\n\n🤖🤖<b>ЗАЯВКА ИЗ БОТА</b>🤖🤖\n\n";
            $telegramUsers = $this->user->getTelegramUsers;
            $username = "";
            foreach($telegramUsers as $user) {
                if($user->username){
                    $username = $user->username;
                } 
            }
            if($username)
                $text .= "Username: @".$username."\n";
        }
        $text .= "ID: ".$this->exchange->id."\n";
        $text .= "Направление обмена ".$this->exchange->currencyFrom->name." -> ".$this->exchange->currencyTo->name."\n";
        $text .= "Сумма: ". $data['amount_data']['amount_send']." -> ". $data['amount_data']['amount_receive']."\n";
        $text .= "Курс обмена: ". $data['amount_data']['exchange_rate']."\n";
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
        if(isset($data['request_data']['city'])){
            $text .= "Город: ".$data['request_data']['city']."\n";
        }
        if(isset($data['request_data']['bank'])){
            $text .= "Банк: ".$data['request_data']['bank']."\n";
        }


        $text .= "\n";
        if($this->user->first_name)
            $text .= "Имя (привязанное к аккаунту): ".$this->user->first_name."\n";
        if($this->user->second_name)
            $text .= "Отчество (привязанное к аккаунту): ".$this->user->second_name."\n";
        if($this->user->last_name)
            $text .= "Фамилия (привязанная к аккаунту): ".$this->user->last_name."\n";
        $text .= "Email (привязанный к аккаунту): ".$this->user->email."\n";


        if(isset($this->exchange->data['request_data']['utm_id'])
            && is_numeric($this->exchange->data['request_data']['utm_id'])){
            $utm = UtmParameter::where("id", $this->exchange->data['request_data']['utm_id'])->first();
            if($utm){
                $text .= "\n";
                if($utm->utm_source) {
                    $text .= "utm_source: ".$utm->utm_source."\n";
                }
                if($utm->utm_medium) {
                    $text .= "utm_medium: ".$utm->utm_medium."\n";
                }
                if($utm->utm_campaign) {
                    $text .= "utm_campaign: ".$utm->utm_campaign."\n";
                }
                if($utm->utm_term) {
                    $text .= "utm_term: ".$utm->utm_term."\n";
                }
                if($utm->utm_content) {
                    $text .= "utm_content: ".$utm->utm_content."\n";
                }
            }
        }
        
        sendTelegramNotification($text);

        if($isTelegramBotExchange){
            if(!isset($this->exchange->data['merchant_from_data']['address']) || !$this->exchange->data['merchant_from_data']['address']){
                return;
            }
            $botUsers = $this->user->getTelegramUsers;
            foreach($botUsers as $botUser){
                $language = $botUser->language;
                $text = $this->tgUserExchangeStartMessage($this->exchange, $language);
                sendTelegramBotUserMessage($text, $botUser, $botUser->getBot, $this->exchange->id);
                sendTelegramBotUserMessage($this->exchange->data['merchant_from_data']['address'], $botUser, $botUser->getBot);
                sendTelegramBotUserMessage($this->exchange->data['amount_data']['amount_send'], $botUser, $botUser->getBot);
            }
        }
    }

    public function checkUser($user_email){
        $user = User::where("email", $user_email)->first();
        if($user){
           $this->user = $user;
           $this->exchange->user_id = $user->id;
           return false; 
        }

        $password = generateRandomString();
        $user = new User;
        $user->email = $user_email;
        $user->password = Hash::make($password);
        $user->save();
        $this->user = $user;
        $this->exchange->user_id = $user->id;
        try {
            Mail::to($this->user->email)->send(new Register($this->user->id, $this->user->email, $password));
        } catch (TransportException $th) {
            sendTelegramNotification("ОШИБКА ОТПРАВКИ EMAIL ПИСЬМА! ".$this->exchange->id."\n".$th->getMessage());
        }
        
        return true;
    }

    public function checkAvailWalletForManualExchange($isCacheMode = false) {
        if($isCacheMode) return ["address" => null,"url" => null];
        if(!$this->exchange->currencyFrom) return ["address" => null,"url" => null];
        if(!@$this->exchange->currencyFrom->data) return ["address" => null,"url" => null];
        $data = $this->exchange->currencyFrom->data;
        if(!isset($data['walletsAvail'])) return ["address" => null,"url" => null];
        if(!is_array($data['walletsAvail'])) return ["address" => null,"url" => null];
        if(count($data['walletsAvail']) == 0) return ["address" => null,"url" => null];
        $currencyData = $data;
        $data = $data['walletsAvail'];
        shuffle($data);

        $address = $data[0];
        $newWallets = [];
        foreach($data as $wallet){
            if($wallet == $address){
                continue;
            }
            $newWallets[] = $wallet;
        }
        $currencyData['walletsAvail'] = $newWallets;
        
        $currency = $this->exchange->currencyFrom;
        $currency->data = $currencyData;
        $currency->save();
        // Cache::forget("currencies-public");
        return ["address" => $address, "url" => null]; 
    }
}
