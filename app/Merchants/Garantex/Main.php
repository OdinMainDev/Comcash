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

    function getValidation($request, $is_withdraw){
        $base = [
            "email" => "required|email|string|max:255",
        ];
        if($is_withdraw){
            $base["to_address"] = "required|string|max:255";
        }
        $request->validate($base);
    }

    function getAddress($merchant, $exchange, $currency){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->create_address($currency);
    }

    function getDeposits($merchant, $exchange){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->request_deposits();
    }

    function sellCurrency($merchant, $exchange){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->sell_currency($exchange->data['amount_data']['currency_from_name'],"USDT",$exchange->data['amount_data']['amount_send']);
    }

    function buyCurrency($merchant, $exchange){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->sell_currency($exchange->data['amount_data']['currency_to_name'],"USDT",$exchange->data['amount_data']['amount_receive'], "buy", "market");
    }

    function makeWithdraw($merchant, $exchange){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->make_withdraw($exchange->currencyTo->name, $exchange->data['amount_data']['amount_receive'], $exchange->data['request_data']['to_address']);
    }

    function getBalance($merchant, $exchange, $currency){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->get_balance($currency);
    }

    function getWithdraws($merchant, $exchange){
        $obj = new Garantex($merchant->id, $exchange->id, $merchant->secret, $merchant->key, env("GARANTEX_HOST_TYPE", 0));
        return $obj->request_withdraws();
    }
}