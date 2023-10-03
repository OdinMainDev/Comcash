<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Jobs\ExchangeStart;
use Illuminate\Http\Request;
use App\Merchants\Handler;
use App\Models\Exchange;

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
            return $this->responseError("currency not found", ["code" => 1]);
        }
        if(!$direction){
            return $this->responseError("bad currency pair", ["code" => 2]);
        }
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_from->units, $request->amount, $direction->profit_percent);
        if(!$amount){
            return $this->responseError("bad amount", ["code" => 3]);
        }
        if(@$direction->data['min_amount'] && $direction->data['min_amount'] > $request->amount){
            return $this->responseError("bad amount (limit min)", ["code" => 4]);
        }
        if(@$direction->data['max_amount'] && $direction->data['max_amount'] < $request->amount){
            return $this->responseError("bad amount (limit max)", ["code" => 5]);
        }
        return $this->responseSuccess(false, [
            "redirect" => route("exchgangePage", [
                "name" => $direction->id,
                "direction_id" => $direction->id, 
                "currency_from" => $currency_from->name,
                "currency_to" => $currency_to->name,
                "amount" => $request->amount,
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
        if(@$direction->data['min_amount'] && $direction->data['min_amount'] > $request->amount){
            return abort(404);
        }
        if(@$direction->data['max_amount'] && $direction->data['max_amount'] < $request->amount){
            return abort(404);
        }
        return view($this->theme.".pages.exchange_1");
    }

    public function create(Request $request) {
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
        ]);
        // получение данных обмена
        $data = $this->getEstimateDataFromRequest($request);
        $amount = $data['amount'];
        $direction = $data['direction'];
        $currency_to = $data['currency_to'];
        $currency_from = $data['currency_from'];
        if(!$currency_to || !$currency_from){
            return $this->responseError("currency not found", ["code" => 1]);
        }
        if(!$direction){
            return $this->responseError("bad currency pair", ["code" => 2]);
        }
        $request->amount = $this->format_amount($request->amount, $currency_from->units);
        // валидирование доп данных от мерчанта
        $merchant_from = new Handler($direction->merchant_type_from);
        $merchant_to = new Handler($direction->merchant_type_to, true);
        $request->validate($merchant_from->getValidation());
        $request->validate($merchant_to->getValidation());
        // валидирование суммы
        $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_from->units, $request->amount, $direction->profit_percent);
        if(!$amount){
            return $this->responseError("bad amount", ["code" => 3]);
        }
        if(@$direction->data['min_amount'] && $direction->data['min_amount'] > $request->amount){
            return $this->responseError("bad amount (limit min)", ["code" => 4]);
        }
        if(@$direction->data['max_amount'] && $direction->data['max_amount'] < $request->amount){
            return $this->responseError("bad amount (limit max)", ["code" => 5]);
        }
        $exchange = new Exchange;
        $exchange->hash = hash("sha256", uniqid().time()."cmcshsaltbyvio");
        $exchange->direction_id = $direction->id;
        $exchange->currency_from = $currency_from->id;
        $exchange->currency_to = $currency_to->id;
        $exchange->merchant_from = $direction->merchant_from;
        $exchange->merchant_to = $direction->merchant_to;
        $exchange->merchant_type_from = $direction->merchant_type_from;
        $exchange->merchant_type_to = $direction->merchant_type_to;
        $exchange->data = [
            "request_data" => $request->all(),
            "amount_data" => [
                "amount_send" => $request->amount,
                "amount_receive" => $amount,
                "exchange_rate" => $this->estimateGetRate($currency_from->name, $currency_to->name)
            ],
            "recalculate" => [
                "has_recalculation" => false
            ]
        ];
        $exchange->save();
        ExchangeStart::dispatch($exchange->id, app()->getLocale());
        return $this->responseSuccess(false, [
            "redirect" => route("exchgangePage2", [
                $exchange->hash
            ])
        ]);
    }
}
