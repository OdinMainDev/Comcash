<?php

namespace App\Merchants\Mpcvip;

use App\Http\Traits\Models\HasLogs;

class Mpcvip {

    use HasLogs;

    public $merchant;
    public $exchange;
    
    function __construct($merchant, $exchange){
        $this->merchant = $merchant;
        $this->exchange = $exchange;
    }
    
    public function create_invoice(){
        $bankids = [1];
        switch($this->exchange->currencyFrom->name){
            case "TCSBRUB":
                $bankids = [2];
            break;
            case "SBERRUB":
                $bankids = [3];
            break;
        }
        $json_data = [
            "amount" => $this->exchange->data['amount_data']['amount_send'],
            "paySource" => 1,
            "callbackURL" => env("APP_URL")."/api/mpcvip/callback",
            "successRedirectURL" => env("APP_URL")."/api/mpcvip/success",
            "failedRedirectURL" => env("APP_URL")."/api/mpcvip/fail",
            "clientIP" => $this->exchange->data['device_data']['ip'],
            "userAgent" => $this->exchange->data['device_data']['user_agent'],
            "cardNumber" => substr(trim($this->exchange->data['request_data']['from_card']), -4),
            "clientInfo" => [
                "client" => $this->exchange->id,
                "email" => $this->exchange->data['request_data']['email'],
                "c_from" => "RUB",
                "c_to" => $this->exchange->data['amount_data']['currency_to_name'],
                "txn" => $this->exchange->id,
                "clientIP" => $this->exchange->data['device_data']['ip'],
                "userAgent" => $this->exchange->data['device_data']['user_agent'],
                "recipient" => trim($this->exchange->data['request_data']['from_card'])
            ],
            "bankIDs" => $bankids,
        ];
        $json_data = json_encode($json_data);

        $request = $this->send_request($json_data, "/api/payment/create_p2p_form");
        if($request['success']){
            $request['typeMerchSys'] = "mpcvip";
            return $request;
        }

        info("ОШИБКА ПРИ MPCVIP");
        info($request);
        info($json_data);

        $this->createMerchantLog(
            $this->merchant->id, 
            $this->exchange->id, 
            "ОШИБКА ПРИ MPCVIP", 
            'https://masterprocessingvip.ru/api/payment/create_p2p_form',
            $json_data, 
            $request
        );
        return false;
    }

    public function send_request($json_data, $method){
        $signature = hash_hmac('sha512', $json_data, $this->merchant->secret);

        $headers = array(
            'Content-Type: application/json',
            'API-Key: ' . $this->merchant->key,
            'Signature: ' . $signature,
        );
        
        $url = 'https://masterprocessingvip.ru/'. ltrim($method, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        $err  = curl_errno($ch);
        $result = curl_exec($ch);
        curl_close($ch);

        return @json_decode($result, true);
    }
	
}