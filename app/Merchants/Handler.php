<?php

namespace App\Merchants;

use App\Merchants\Garantex\Main as Garantex;
use App\Merchants\Mpcvip\Main as MpcVip;
use App\Merchants\Binance\Main as Binance;

class Handler {

    protected $merchant;
    protected $merchant_name;
    protected $is_withdraw;

    public function __construct($name, $is_withdraw = false) {
        $this->merchant = false;
        $this->merchant_name = $name;
        $this->is_withdraw = $is_withdraw;
    }

    public function getLayout(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getLayout($this->is_withdraw);
    }

    public function getValidation(){
        $this->merchant = $this->getMerchant();
        if(!$this->merchant){
            return false;
        }

        return $this->merchant->getValidation($this->is_withdraw);
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
            case "binance":
                $this->merchant = new Binance;
                return $this->merchant;
            break;
        }    
        
        return false;
    }
}