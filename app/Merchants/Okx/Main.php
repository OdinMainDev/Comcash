<?php

namespace App\Merchants\Okx;

use ccxt\okx;

class Main {

    function getLayout($is_withdraw){
        $base = ["email"];
        if($is_withdraw){
            $base[] = "to_address";
        }
        return $base;
    }

    function getValidation($is_withdraw){
        $base = [
            "email" => "required|email|string|max:255",
        ];
        if($is_withdraw){
            $base["to_address"] = "required|string|max:255";
        }
        return $base;
    }

    function getAddress($merchant, $exchange, $currency){
        $obj = new okx([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
        ]);
        dd($obj->fetch_currencies());
        dd($obj->fetch_deposit_address($currency));
    }

}