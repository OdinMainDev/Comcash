<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use Illuminate\Http\Request;

class Controller_Exchange extends Controller{

    use HasCache;

    public function redirect(Request $request) {
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
        ]);
        $data = $this->getEstimateDataFromRequest($request);
        $amount = $data['amount'];
        $direction = $data['direction'];
        $currency_to = $data['currency_to'];
        $currency_from = $data['currency_from'];
        if(!$currency_to || !$currency_from){
            return $this->responseError("currency not found");
        }
        if(!$direction){
            return $this->responseError("bad currency pair");
        }
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_from->units, $request->amount, $direction->profit_percent);
        if(!$amount){
            return $this->responseError("bad amount");
        }
        return $this->responseSuccess(false, [
            "redirect" => route("exchgangePage", [
                "name" => $direction->id,
                "direction_id" => $direction->id, 
                "currency_from" => $currency_from->name,
                "currency_to" => $currency_to->name,
                "amount" => $amount,
            ])
        ]);
    }

    public function view(Request $request) {
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
        ]);
        $data = $this->getEstimateDataFromRequest($request);
        $amount = $data['amount'];
        $direction = $data['direction'];
        $currency_to = $data['currency_to'];
        $currency_from = $data['currency_from'];
        if(!$currency_to || !$currency_from){
            return abort(404);
        }
        if(!$direction){
            return abort(404);
        }
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_from->units, $request->amount, $direction->profit_percent);
        if(!$amount){
            return abort(404);
        }
        return view($this->theme.".pages.exchange_1");
    }
}
