<?php

namespace App\Merchants\Mpcvip;

class Main {

    function getLayout($is_withdraw){
        $base = ["first_name", "second_name", "last_name", "email", "phone", "telegram"];
        if(!$is_withdraw){
            $base[] = "from_card";
        }else{
            $base[] = "to_card";
        }

        return $base;
    }
}