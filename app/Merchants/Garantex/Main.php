<?php

namespace App\Merchants\Garantex;

class Main {

    function getLayout($is_withdraw){
        $base = ["email", "from_address"];
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
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->create_address($currency);
    }
}