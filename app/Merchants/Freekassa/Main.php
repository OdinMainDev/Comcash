<?php

namespace App\Merchants\Freekassa;

use App\Http\Traits\Misc\HasAmount;
use App\Http\Traits\Models\HasLogs;

class Main {

    use HasAmount, HasLogs;

    function getLayout($is_withdraw){
        // $base = ["first_name", "second_name", "last_name", "email"];
        $base = ["email"];
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
            $base["from_card"] = "required|string|max:20";
        }else{
            $base["to_card"] = "required|string|max:20";
        }
        return $base;
    }

    function getAddress($merchant, $exchange, $currency){
        $obj = new Freekassa($merchant, $exchange);
        return $obj->create_invoice();
    }

    function getDeposits($merchant, $exchange){
        $obj = new Freekassa($merchant, $exchange);
        return $obj->get_invoices();
    }

    function sellCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function buyCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function makeWithdraw($merchant, $exchange){
        $obj = new Freekassa($merchant, $exchange);
        $resp = $obj->make_withdraw();
        if(@$resp['status'] != "Accepted"){
            if(!is_array($resp)){
                $resp = [];
            }
            $resp['error'] = [
                "code" => @$resp['status'],
                "message" => @$resp['cause']
            ];
        }
        return $resp;
    }

    function getWithdraws($merchant, $exchange){
        $obj = new Freekassa($merchant, $exchange);
        return $obj->get_withdraws();
    }
}