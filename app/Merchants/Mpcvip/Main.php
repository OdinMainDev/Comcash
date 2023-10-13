<?php

namespace App\Merchants\Mpcvip;

use App\Http\Traits\Misc\HasAmount;

class Main {

    use HasAmount;


    /* 
        url:https://masterprocessingvip.ru/api/payment/create_p2p_form
        headers:Array ( [0] => Content-Type: application/json [1] => API-Key: YsmWqy50yOAXklT6O0D9PzqnHSDuzhPUralvxn35VfYn1tTjR85pbQwopldB3P1tq9zJoy8lsJPD1FRTHxFYOPTpL1h5fbGXLr97zRP99ivMVAsReVAuHZxQrDrAUJUmo7ix1x8gG4Wc7ShDIkbWzIowc9UJDXWx50iblPMkQjbqfqAsFpdx5zPkjIS2DrDiNHtBaj8ioq7lX43YiAXatrFHFdEv4gGV8zj3w8aIJneUALsoXgYoVJQ0nkZt2GuB [2] => Signature: 033baa0f837712ed3dfd65507930b5ba246801c30f51b703f839752ea02b963bd3ba17aa684531c97f7b13aa9868580e608202d15d20bba6f9f195e646f08c82 )
        post_data:{"amount":5000,"paySource":1,"callbackURL":"https://comcash.io/merchant-mpcvip4_status.html?order_id=261","successRedirectURL":"https://comcash.io/hst_6di6icf7ke8xrrqmwewr8opctrfjzn4bali/","failedRedirectURL":"https://comcash.io/hst_6di6icf7ke8xrrqmwewr8opctrfjzn4bali/","clientIP":"185.107.44.97","userAgent":"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36","cardNumber":"4444","clientInfo":{"client":"1","email":"lightindarkness@comcash.io","c_from":"RUB","c_to":"BTC","txn":"261","ip":"185.107.44.97","user_agent":"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36","recipient":"4444444444444444"},"bankIDs":[3]}
        result:{"externalID":"P2P-cf005187-8a31-46bb-a1c1-5059842daadf","success":true,"cardNumber":"","paymentURL":"https://v2.cardforpay24.com/v2-f7f1b170-501e-4c18-8ee5-6a2012e99788?formID=1","bankName":"","qrCode":"","paymentLink":"","cardHolderName":"","cause":"","traceID":"","ifc":""}

    */

    function getLayout($is_withdraw){
        $base = ["first_name", "second_name", "last_name", "email", "phone", "telegram"];
        if(!$is_withdraw){
            $base[] = "from_card";
        }else{
            $base[] = "from_card";
            $base[] = "to_card";
        }

        return $base;
    }

    function getValidation($is_withdraw){
        $base = [
            "first_name" => "required|string|max:255",
            "second_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email" => "required|email|string|max:255",
        ];
        if(!$is_withdraw){
            $base["from_card"] = "required|string|max:20";
        }else{
            $base["to_card"] = "required|string|max:20";
        }
        return $base;
    }

    function getAddress($merchant, $exchange, $currency){
        //alpha - 6 | sber - 3 | tinkoff - 2 | all - 1

        $bankids = [1];
        switch($exchange->currencyFrom->name){
            case "TCSBRUB":
                $bankids = [2];
            break;
            case "SBERRUB":
                $bankids = [3];
            break;
        }
        $json_data = [
            "amount" => (int) $this->toInt($exchange->data['amount_data']['amount_send'], 2),
            "paySource" => 1,
            "callbackURL" => env("APP_URL")."/api/mpcvip/callback",
            "successRedirectURL" => env("APP_URL")."/api/mpcvip/success",
            "failedRedirectURL" => env("APP_URL")."/api/mpcvip/fail",
            "clientIP" => $exchange->data['device_data']['ip'],
            "userAgent" => $exchange->data['device_data']['user_agent'],
            "cardNumber" => substr(trim($exchange->data['request_data']['from_card']), -4),
            "clientInfo" => [
                "client" => $exchange->id,
                "email" => $exchange->data['request_data']['email'],
                "c_from" => "RUB",
                "c_to" => $exchange->data['amount_data']['currency_to_name'],
                "txn" => $exchange->id,
                "clientIP" => $exchange->data['device_data']['ip'],
                "userAgent" => $exchange->data['device_data']['user_agent'],
                "recipient" => trim($exchange->data['request_data']['from_card'])

            ],
            "bankIDs" => $bankids,
        ];

        $json_data = json_encode($json_data);

        $signature = hash_hmac('sha512', $json_data, $merchant->secret);
        $request = $this->sendRequest($json_data, $merchant->key, $signature, "/api/payment/create_p2p_form");
        if(!$request['success']){
            info("ОШИБКА ПРИ MPCVIP");
            info($request);
            info($json_data);
            return false;
        }

        $request['typeMerchSys'] = "mpcvip";
        return $request;
    }

    function sendRequest($json, $api_key, $signature, $method) {
        $headers = array(
            'Content-Type: application/json',
            'API-Key: ' . $api_key,
            'Signature: ' . $signature,
        );
        
        $url = 'https://masterprocessingvip.ru/'. ltrim($method, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
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