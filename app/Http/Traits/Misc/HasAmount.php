<?php
     
namespace App\Http\Traits\Misc;

trait HasAmount {

    public function toInt($amount, $minor_units){
        if($amount == 0){
            return 0;
        }
        $amount = sprintf('%f', $amount);
        if($minor_units == 0)
            return $amount;

        return bcmul($amount, pow(10, $minor_units), 0);
    }

    public function toFloat($amount, $minor_units){
        if($amount == 0){
            return 0;
        }
        $amount = sprintf('%f', $amount);
        if($minor_units == 0)
            return $amount;

        return bcdiv($amount, pow(10, $minor_units), $minor_units);
    }

}