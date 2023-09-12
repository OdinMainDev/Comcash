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
}