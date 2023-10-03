<?php

namespace App\Merchants\Binance;

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
}