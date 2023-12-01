<?php

namespace App\Merchants\Bybit;

use App\Http\Traits\Models\HasLogs;
use ccxt\bybit;

class Main {

    use HasLogs;

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
            $base["to_address"] = "required|string|max:255";
        }
        return $base;
    }

    function getAddress($merchant, $exchange, $currency){
        $obj = new bybit([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
            "password" => $merchant->token
        ]);
        try {
            $result = $obj->fetch_deposit_address($currency);
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "generate address", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token
                ], 
                $result
            );
            if(!isset($result['address'])){
                return false;
            }
            return $result['address'];
        } catch (\Throwable $th) {
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "generate address error", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token
                ], 
                $th->getMessage()
            );
            return false;
        }
        if(!isset($result['address'])){
            return false;
        }
        return $result['address'];
    }

    function getDeposits($merchant, $exchange){
        $obj = new bybit([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
            "password" => $merchant->token
        ]);
        try {
            $result = $obj->fetch_deposits();
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "get deposits", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token
                ], 
                $result
            );
            return $result;
        } catch (\Throwable $th) {
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "generate address error", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token
                ], 
                $th->getMessage()
            );
            return [];
        }
        return $result;
    }

    function sellCurrency($merchant, $exchange){
        if(@$exchange->data['amount_data']['currency_from_name'] == "USDT"){
            return [];
        }
        $obj = new bybit([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
            "password" => $merchant->token
        ]);
        try {
            $result = $obj->create_market_sell_order($exchange->data['amount_data']['currency_from_name']."-USDT", $exchange->data['amount_data']['amount_send']);
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "sell currency", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_from_name']."-USDT",
                    "amount" => $exchange->data['amount_data']['amount_send'],
                ], 
                $result
            );
            return $result;
        } catch (\Throwable $th) {
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "sell currency with error", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_from_name']."-USDT",
                    "amount" => $exchange->data['amount_data']['amount_send'],
                ], 
                $th->getMessage()
            );

            return [
                "error" => [
                    "code" => $th->getMessage(),
                    "message" => $th->getMessage(),
                ]
            ];
        }

        return [
            "error" => [
                "code" => "undefined bybit error",
                "message" => "undefined bybit error",
            ]
        ];
    }

    function buyCurrency($merchant, $exchange){
        $obj = new bybit([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
            "password" => $merchant->token
        ]);
        try {
            $result = $obj->create_market_buy_order($exchange->data['amount_data']['currency_to_name']."-USDT", $exchange->data['amount_data']['amount_receive']);
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "buy currency", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_to_name']."-USDT",
                    "amount" => $exchange->data['amount_data']['amount_receive'],
                ], 
                $result
            );
            return $result;
        } catch (\Throwable $th) {
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "buy currency with error", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_to_name']."-USDT",
                    "amount" => $exchange->data['amount_data']['amount_receive'],
                ], 
                $th->getMessage()
            );

            return [
                "error" => [
                    "code" => $th->getMessage(),
                    "message" => $th->getMessage(),
                ]
            ];
        }

        return [
            "error" => [
                "code" => "undefined bybit error",
                "message" => "undefined bybit error",
            ]
        ];
    }

    function makeWithdraw($merchant, $exchange){
        $obj = new bybit([
            "apiKey" => $merchant->key,
            "secret" => $merchant->secret,
            "password" => $merchant->token
        ]);
        try {
            $result = $obj->withdraw($exchange->data['amount_data']['currency_to_name'], $exchange->data['amount_data']['amount_receive'], $exchange->data['request_data']['to_address'],
         null, [
            "network" => "Etherium",
            "fee" => 0,
         ]);
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "withdraw", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_to_name'],
                    "amount" => $exchange->data['amount_data']['amount_receive'],
                    "to_address" => $exchange->data['request_data']['to_address']
                ], 
                $result
            );
            return $result;
        } catch (\Throwable $th) {
            $this->createMerchantLog(
                $merchant->id, 
                $exchange->id, 
                "withdraw with error", 
                "",
                [
                    "apiKey" => $merchant->key,
                    "secret" => $merchant->secret,
                    "password" => $merchant->token,
                    "currency" => $exchange->data['amount_data']['currency_to_name'],
                    "amount" => $exchange->data['amount_data']['amount_receive'],
                    "to_address" => $exchange->data['request_data']['to_address']
                ], 
                $th->getMessage()
            );

            return [
                "error" => [
                    "code" => $th->getMessage(),
                    "message" => $th->getMessage(),
                ]
            ];
        }

        return [
            "error" => [
                "code" => "undefined bybit error",
                "message" => "undefined bybit error",
            ]
        ];
    }

}