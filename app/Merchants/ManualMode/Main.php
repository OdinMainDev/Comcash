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
    public $isCash = false;
    public $isSbp = false;

    public function __construct($isCrypto = false, $isCash = false, $isSbp = false){
        $this->isCrypto = $isCrypto;
        $this->isCash = $isCash;
        $this->isSbp = $isSbp;
    }

    function getLayout($is_withdraw){
        $base = ["email"];

        if($this->isCash) {
            $base[] = "telegram";
            $base[] = "city";
            return $base;
        }

        if(!$is_withdraw){
            if(!$this->isCrypto && !$this->isSbp){
                $base[] = "from_card";
                if(env("THEME_NAME", "comcash") == "onlybot")
                    $base[] = "first_name";
            }
        }else{
            if(!$this->isCrypto && !$this->isSbp)
                $base[] = "to_card";
            else if($this->isCrypto)
                $base[] = "to_address";
            else if($this->isSbp){
                $base[] = "phone";
                $base[] = "bank";
                $base[] = "first_name";
                // $base[] = "second_name";
                if(env("THEME_NAME", "comcash") != "onlybot")
                    $base[] = "last_name";
            }
        }

        return $base;
    }

    function getLayoutTelegram($is_withdraw){
        $base = [];

        if($this->isCash) {
            $base[] = "city";
            return $base;
        }

        
        if(!$is_withdraw){
            if(!$this->isCrypto && !$this->isSbp){
                $base[] = "from_card";
                if(env("THEME_NAME", "comcash") == "onlybot")
                    $base[] = "first_name";
            }
        }else{
            if(!$this->isCrypto && !$this->isSbp)
                $base[] = "to_card";
            else if($this->isCrypto)
                $base[] = "to_address";
            else if($this->isSbp){
                $base[] = "phone";
                $base[] = "bank";
                $base[] = "first_name";
                // $base[] = "second_name";
                if(env("THEME_NAME", "comcash") != "onlybot")
                    $base[] = "last_name";
            }
        }

        return $base;
    }

    function getValidation($request, $is_withdraw){
        $base = [
            "email" => "required|email|string|max:255",
        ];

        if($this->isCash) {
            $base["telegram"] = "required|string|max:60";
            $base["city"] = "required|string|max:255";
            return $base;
        }
        
        if(!$this->isCrypto && !$this->isCash){
            // $base["first_name"] = "required|string|max:255";
            // $base["second_name"] = "required|string|max:255";
            // $base["last_name"] = "required|string|max:255";
        }
       if(!$is_withdraw){
            if(!$this->isCrypto && !$this->isSbp){
                $base["from_card"] = "required|string|max:20";
                if(env("THEME_NAME", "comcash") == "onlybot")
                    $base["first_name"] = "required|string|max:255";
            }
        }else{
            if(!$this->isCrypto && !$this->isSbp)
                $base["to_card"] = "required|string|max:20";
            else if($this->isCrypto)
                $base["to_address"] = "required|string|max:255";
            else if($this->isSbp){
                $base["phone"] = "required|string|max:255";
                $base["bank"] = "required|string|max:255";
                $base["first_name"] = "required|string|max:255";
                // $base["second_name"] = "required|string|max:255";
                if(env("THEME_NAME", "comcash") != "onlybot")
                    $base["last_name"] = "required|string|max:255";
            }
        }

        $request->validate($base);
    }

    function getAddress($merchant, $exchange, $currency){
        return [
            "is_manual_mode" => true,
            "is_cache_mode" => $this->isCash
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