<?php
     
namespace App\Http\Traits\Models;

use App\Models\UtmExchanges;

trait HasUtm {

    public function addExchangeToUtm($exchange, $utm_id){
        $model = new UtmExchanges;
        $model->direction = $exchange->currencyFrom->name." -> ".$exchange->currencyTo->name;
        $model->exchange_id = $exchange->id;
        $model->utm_id = $utm_id;
        $model->is_completed = false;
        $model->save();
    }

    public function setUtmExchangeAsCompleted($exchange, $utm_id){
        $model = UtmExchanges::where("exchange_id", $exchange->id)->where("utm_id", $utm_id)->first();
        if(!$model){
            $model = new UtmExchanges;
            $model->direction = $exchange->currencyFrom->name." -> ".$exchange->currencyTo->name;
            $model->exchange_id = $exchange->id;
            $model->utm_id = $utm_id;
        }
        $model->is_completed = true;
        $model->save();
    }
}