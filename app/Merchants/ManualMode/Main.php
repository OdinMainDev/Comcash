<?php

namespace App\Merchants\ManualMode;

use App\Http\Traits\Misc\HasAmount;
use App\Http\Traits\Models\HasKyc;
use App\Http\Traits\Models\HasLogs;
use App\Merchants\Kyc;
use App\Models\KycCheck;
use Illuminate\Validation\ValidationException;

class Main {

    use HasAmount, HasLogs, HasKyc;
    public $isCrypto = false;

    public function __construct($isCrypto = false){
        $this->isCrypto = $isCrypto;
    }

    function getLayout($is_withdraw){
        $base = ["email"];
        if(!$this->isCrypto){
            $base[] = "first_name";
            $base[] = "second_name";
            $base[] = "last_name";
        }

        if(!$is_withdraw){
            if(!$this->isCrypto)
                $base[] = "from_card";
        }else{
            if(!$this->isCrypto)
                $base[] = "to_card";
            else
                $base[] = "to_address";
        }

        return $base;
    }

    function getLayoutTelegram($is_withdraw){
        $base = [];
        if(!$is_withdraw){
            if(!$this->isCrypto)
                $base[] = "from_card";
        }else{
            if(!$this->isCrypto)
                $base[] = "to_card";
            else
                $base[] = "to_address";
        }
        return $base;
    }

    function getValidation($request, $is_withdraw){
        $base = [
            "email" => "required|email|string|max:255",
        ];
        
        if(!$this->isCrypto){
            $base["first_name"] = "required|string|max:255";
            $base["second_name"] = "required|string|max:255";
            $base["last_name"] = "required|string|max:255";
        }
        if(!$is_withdraw){
            if(!$this->isCrypto)
                $base["from_card"] = "required|string|max:20";
        }else{
            if(!$this->isCrypto)
                $base["to_card"] = "required|string|max:20";
            else
                $base["to_address"] = "required|string|max:255";
        }
        $request->validate($base);
    }

    function getAddress($merchant, $exchange, $currency){
        return [
            "is_manual_mode" => true
        ];
    }

    function getDeposits($merchant, $exchange){
        // $obj = new Aifory($merchant, $exchange);
        // return $obj->get_invoices();
    }

    function sellCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function buyCurrency($merchant, $exchange){
        return ["success" => true];
    }

    function makeWithdraw($merchant, $exchange){
        // $obj = new Aifory($merchant, $exchange);
        // $resp = $obj->make_withdraw();
        // if(@$resp['status'] != "accepted"){
        //     if(!is_array($resp)){
        //         $resp = [];
        //     }
        //     $resp['error'] = [
        //         "code" => @$resp['status'],
        //         "message" => @$resp['cause']
        //     ];
        // }
        // return $resp;
    }

    function getWithdraws($merchant, $exchange){
        // $obj = new Aifory($merchant, $exchange);
        // return $obj->get_withdraws();
    }
}