<?php

namespace App\Merchants\Aifory;

use App\Http\Traits\Misc\HasAmount;
use App\Http\Traits\Models\HasKyc;
use App\Http\Traits\Models\HasLogs;
use App\Merchants\Kyc;
use App\Models\KycCheck;
use Illuminate\Validation\ValidationException;

class Main {

    use HasAmount, HasLogs, HasKyc;

    function getLayout($is_withdraw){
        $base = ["first_name", "second_name", "last_name", "email"];
        if(!$is_withdraw){
            $base[] = "from_card";
        }else{
            $base[] = "to_card";
        }

        return $base;
    }

    function getValidation($request, $is_withdraw){
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
        $request->validate($base);
        $card = $request->from_card ? $request->from_card : $request->to_card;
        $cred = $request->first_name." ".$request->second_name." ".$request->last_name;
        $this->checkForKyc($cred, $card);
    }

    function getAddress($merchant, $exchange, $currency){
        $obj = new Aifory($merchant, $exchange);
        return $obj->create_invoice();
    }

    function getDeposits($merchant, $exchange){
        $obj = new Aifory($merchant, $exchange);
        return $obj->get_invoices();
    }

    function sellCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function buyCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function makeWithdraw($merchant, $exchange){
        $obj = new Aifory($merchant, $exchange);
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
        $obj = new Aifory($merchant, $exchange);
        return $obj->get_withdraws();
    }
}