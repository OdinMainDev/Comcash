<?php

namespace App\Merchants\Mpcvip;

class Main {

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
            $base[] = "from_card";
        }else{
            $base[] = "to_card";
        }
        return $base;
    }
}