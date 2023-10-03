<?php

namespace App\Merchants\Garantex;

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
            $base[] = "to_address";
        }
        return $base;
    }

    function getAddress($merchant_id, $exchange_id, $private_key, $uid, $currency){
        $obj = new Garantex($merchant_id, $exchange_id, $private_key, $uid, env("GARANTEX_HOST_TYPE", 0));
        return $obj->create_address($currency);
    }
}