<?php

namespace App\Merchants\Aifory;

use App\Http\Traits\Models\HasLogs;

class Aifory {

    use HasLogs;

    public $merchant;
    public $exchange;
    
    function __construct($merchant, $exchange){
        $this->merchant = $merchant;
        $this->exchange = $exchange;
    }
    
    public function create_invoice(){
        $bankids = false;
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
            "currencyID" => 3,
            "typeID" => 4,
            "clientOrderID" => "".$this->exchange->user_id,
            "webhookURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
            "extra" => [
                "comment" => "payin for comcash engine: ".$this->exchange->id,
                "allowedMethodIDs" => $bankids ? $bankids : [1,2,3,4,5,6,7,8,10],
                "successRedirectURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
                "failedRedirectURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
                "payerInfo" => [
                    "userAgent" => $this->exchange->data['device_data']['user_agent'],
                    "IP" => $this->exchange->data['device_data']['ip'],
                    "userID" => $this->exchange->id,
                    "fingerprint" =>  $this->exchange->data['device_data']['fid'],
                    "registeredAt" => time()
                ],
            ]
        ];
        $json_data = json_encode($json_data);

        $request = $this->send_request($json_data, "/payin/process");
        if($request && @$request['status'] == "accepted"){
            $request['typeMerchSys'] = "aifory";
            return $request;
        }
        info("ОШИБКА ПРИ AIFORY");
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
            'User-Agent: '.$this->merchant->token
        );
        
        $url = 'https://api.aifory.io/'. ltrim($method, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->merchant->token);
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
        // dd($result, $url, $err, $json_data);
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
            "ID" => @$this->exchange->data['merchant_from_data']['orderID'],
        ];
        return $this->send_request(json_encode($json_data), "/payin/details");
    }

    public function make_withdraw(){
        $json_data = [
            "currencyID" => 3,
            "recipientTypeID" => 1,
            "recipient" => str_replace(' ', '', $this->exchange->data['request_data']['to_card']),
            "amount" => (int) ceil($this->exchange->data['amount_data']['amount_receive']),
            "clientOrderID" => "".$this->exchange->user_id,
            "webhookURL" => route("exchgangePage2", ["locale" => $this->exchange->data['device_data']['language'], "hash" => $this->exchange->hash]),
            "extra" => [
                "destTag" => "1234567"
            ],
        ];
        $json_data = json_encode($json_data);

        $request = $this->send_request($json_data, "/payout/process");
        if($request['status'] == "Accepted"){
            $request['typeMerchSys'] = "aifory";
            return $request;
        }

        info("ОШИБКА ПРИ AIFORY ВЫПЛАТЕ");
        info($request);
        info($json_data);

        return $request;
    }

    public function get_withdraws(){
        $json_data = [
            "ID" => @$this->exchange->data['merchant_from_data']['orderID'],
        ];
        $json_data = json_encode($json_data);

        return $this->send_request($json_data, "/payout/details");
    }
	
}