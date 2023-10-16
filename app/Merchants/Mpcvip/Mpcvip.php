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
            "amount" => ceil($this->exchange->data['amount_data']['amount_send']),
            "paySource" => 1,
            "callbackURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
            "successRedirectURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
            "failedRedirectURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
            "clientIP" => $this->exchange->data['device_data']['ip'],
            "userAgent" => $this->exchange->data['device_data']['user_agent'],
            "cardNumber" => substr(str_replace(' ', '', $this->exchange->data['request_data']['from_card']), -4),
            "clientInfo" => [
                "client" => $this->exchange->id,
                "email" => $this->exchange->data['request_data']['email'],
                "c_from" => "RUB",
                "c_to" => $this->exchange->data['amount_data']['currency_to_name'],
                "txn" => $this->exchange->id,
                "clientIP" => $this->exchange->data['device_data']['ip'],
                "userAgent" => $this->exchange->data['device_data']['user_agent'],
                "recipient" => str_replace(' ', '', $this->exchange->data['request_data']['from_card'])
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

        return false;
    }

    public function send_request($json_data, $method){
        if(is_array($json_data)){
            $json_data = json_encode($json_data);
        }
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

        $res = @json_decode($result, true);

        $this->createMerchantLog(
            $this->merchant->id, 
            $this->exchange->id, 
            $method, 
            $url,
            $json_data, 
            $res
        );

        return $res;
    }

    public function get_invoices(){
        $json_data = [
            "orderType" => "invoice",
        ];
        $json_data = json_encode($json_data);

        return $this->send_request($json_data, "/api/payment/fetch_order_history");
    }

    public function make_withdraw(){
        $json_data = [
            "recipient" => str_replace(' ', '', $this->exchange->data['request_data']['to_card']),
            "amount" => (int) ceil($this->exchange->data['amount_data']['amount_receive']),
            "UID" => "uid-".$this->exchange->id,
            "clientInfo" => [
                "client" => $this->exchange->id,
                "email" => $this->exchange->data['request_data']['email'],
                "c_from" => "RUB",
                "c_to" => $this->exchange->data['amount_data']['currency_to_name'],
                "txn" => $this->exchange->id,
                "clientIP" => $this->exchange->data['device_data']['ip'],
                "userAgent" => $this->exchange->data['device_data']['user_agent'],
                "recipient" => (string) str_replace(' ', '', $this->exchange->data['request_data']['to_card'])
            ],
        ];
        $json_data = json_encode($json_data);

        $request = $this->send_request($json_data, "/api/payment/withdraw_to_card_v2");
        if($request['status'] == "Accepted"){
            $request['typeMerchSys'] = "mpcvip";
            return $request;
        }

        info("ОШИБКА ПРИ MPCVIP ВЫПЛАТЕ");
        info($request);
        info($json_data);

        return $request;
    }

    public function get_withdraws(){
        $json_data = [
            "UID" => "uid-".$this->exchange->id,
        ];
        $json_data = json_encode($json_data);

        return $this->send_request($json_data, "/api/payment/get_withdraw_order_info_by_uid");
    }
	
}