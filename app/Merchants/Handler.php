<?php

namespace App\Merchants;

use App\Merchants\Garantex\Main as Garantex;
use App\Merchants\Mpcvip\Main as MpcVip;
use App\Merchants\Okx\Main as Okx;
use App\Merchants\Freekassa\Main as Freekassa;
use App\Merchants\Bybit\Main as Bybit;
use App\Merchants\Aifory\Main as Aifory;
use stdClass;

class Handler {

    protected $merchant;
    protected $merchant_name;
    protected $is_withdraw;
    protected $merchant_data;
    protected $exchange_data;

    public function __construct($name, $is_withdraw = false, $merchant_data = new stdClass, $exchange_data = new stdClass) {
        $this->merchant = false;
        $this->merchant_name = $name;
        $this->is_withdraw = $is_withdraw;
        $this->merchant_data = $merchant_data;
        $this->exchange_data = $exchange_data;
    }

    public function getLayout(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getLayout($this->is_withdraw);
    }

    public function getValidation($request){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getValidation($request, $this->is_withdraw);
    }

    public function getMerchant(){
        if(!$this->merchant_name)
            return false;
        
        switch($this->merchant_name){
            case "garantex":
                $this->merchant = new Garantex;
                return $this->merchant;
            break;
            case "mpcvip":
                $this->merchant = new MpcVip;
                return $this->merchant;
            break;
            case "okx":
                $this->merchant = new Okx;
                return $this->merchant;
            break;
            case "freekassa":
                $this->merchant = new Freekassa;
                return $this->merchant;
            break;
            case "bybit":
                $this->merchant = new Bybit;
                return $this->merchant;
            break;
            case "aifory":
                $this->merchant = new Aifory;
                return $this->merchant;
            break;
        }    
        
        return false;
    }

    public function create_address($currency){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getAddress($this->merchant_data, $this->exchange_data, $currency);
    }

    public function getDeposits(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getDeposits($this->merchant_data, $this->exchange_data);
    }

    public function sellCurrency(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->sellCurrency($this->merchant_data, $this->exchange_data);
    }

    public function buyCurrency(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->buyCurrency($this->merchant_data, $this->exchange_data);
    }

    public function makeWithdraw(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->makeWithdraw($this->merchant_data, $this->exchange_data);
    }

    public function getBalance($currency){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getBalance($this->merchant_data, $this->exchange_data, $currency);
    }

    public function getWithdraws(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getWithdraws($this->merchant_data, $this->exchange_data);
    }
}