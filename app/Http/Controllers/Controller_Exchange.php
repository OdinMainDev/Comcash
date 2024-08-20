<?php

namespace App\Http\Controllers;

use App\Http\Traits\Misc\HasTelegramMessage;
use App\Http\Traits\Models\HasCache;
use App\Jobs\ExchangeStart;
use Illuminate\Http\Request;
use App\Merchants\Handler;
use App\Models\Exchange;

class Controller_Exchange extends Controller{

    use HasCache, HasTelegramMessage;

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
            return $this->responseError("bad amount (limit max)", ["code" => 5, $direction->data['max_amount'], $request->amount]);
        }
        return $this->responseSuccess(false, [
            "redirect" => route("exchgangePage", [
                "name" => $direction->id,
                "direction_id" => $direction->id, 
                "currencyFrom" => $currency_from->name,
                "currencyTo" => $currency_to->name,
                "amount" => $request->amount,
            ])
        ]);
    }

    public function view(Request $request, $lang, $currencyFrom, $currencyTo) {
        $request->merge(["currency_from" => $currencyFrom]);
        $request->merge(["currency_to" => $currencyTo]);
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "nullable|numeric",
        ]);

        $data = $this->getEstimateDataFromRequest($request);
        if(!$request->has("amount")) {
            $request->merge(['amount' => $data['amount_from']]);
        }
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

        $lang = mb_strtolower(app()->getLocale());
        $seo_data = [
            "page" => "exchgangePage",
            "title" => @$direction->data['seo']['titles'][$lang] ? $direction->data['seo']['titles'][$lang] : ucfirst($this->theme),
            "description" => @$direction->data['seo']['descriptions'][$lang] ? $direction->data['seo']['descriptions'][$lang] : ucfirst($this->theme),
            "keywords" => @$direction->data['seo']['keywords'][$lang] ?  explode(",", $direction->data['seo']['keywords'][$lang]) : [ucfirst($this->theme)]
        ];

        $this->setSeoData($seo_data, ["currencyFrom" => $currencyFrom, "currencyTo" => $currencyTo]);
        return view($this->theme.".pages.exchange_1")
            ->with("currencyFrom", $currencyFrom)
            ->with("currencyTo", $currencyTo)
            ->with("direction", $direction)
            ->with("seo_directions", $this->getRandomDirections(10));
    }

    public function create(Request $request) {
        $request->validate([
            "currency_from" => "required|string|max:255",
            "currency_to" => "required|string|max:255",
            "amount" => "required|numeric",
            "amount_to" => "required|numeric",
            "fid" => "required|string",
            "reverse" => "nullable|in:0,1"
        ]);
        // получение данных обмена
        $data = $this->getEstimateDataFromRequest($request, $request->reverse == "1", $request->amount_to);
        $amountFrom = $request->reverse == "1" ? $data['amount'] : $request->amount;
        $amountTo = $request->reverse == "1" ? $request->amount_to : $data['amount'];
        $direction = $data['direction'];
        $currency_to = $data['currency_to'];
        $currency_from = $data['currency_from'];
        if(!$currency_to || !$currency_from){
            return $this->responseError("currency not found", ["code" => 1]);
        }
        if(!$direction){
            return $this->responseError("bad currency pair", ["code" => 3]);
        }
        $request->merge(['aff_id' => $request->cookie("aff_hash")]);
        $request->merge(['utm_id' => $request->cookie("utm_hash")]);
        $request->merge(['amount' => $this->format_amount($amountFrom, $currency_from->units)]);
        $request->merge(['amount_to' => $this->format_amount($amountTo, $currency_to->units)]);
        // валидирование доп данных от мерчанта
        $merchant_from = new Handler($direction->merchant_type_from);
        $merchant_to = new Handler($direction->merchant_type_to, true);
        $merchant_from->getValidation($request);
        $merchant_to->getValidation($request);
        // валидирование суммы
        // $amount = $this->estimateAmount($currency_from->name, $currency_to->name, $currency_to->units, $amountFrom, $direction->profit_percent);

        if(!$amountFrom){
            return $this->responseError("bad amount", ["code" => 3]);
        }
        if(@$direction->data['min_amount'] && $direction->data['min_amount'] > $amountFrom){
            return $this->responseError("bad amount (limit min)", ["code" => 4]);
        }
        if(@$direction->data['max_amount'] && $direction->data['max_amount'] < $amountFrom){
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
            "device_data" => [
                "ip" => $request->ip(),
                "user_agent" => $request->userAgent(),
                "language" => app()->getLocale(),
                "fid" => $request->fid,

            ],
            "amount_data" => [
                "amount_send" => $amountFrom,
                "amount_send_usd" => $this->estimateAmount($currency_from->name, "USD", 2, $amountFrom, $direction->profit_percent),
                "amount_receive" => $amountTo,
                "amount_receive_usd" => $this->estimateAmount($currency_to->name, "USD", 2, $amountTo, 0),
                "exchange_rate" => $this->estimateGetRate($currency_from->name, $currency_to->name),
                "exchange_rate_to_usd" => $this->estimateGetRate($currency_from->name, "USD"),
                "currency_from_name" => $this->convertCurrencyName($currency_from->name),
                "currency_to_name" => $this->convertCurrencyName($currency_to->name)
            ],
            "recalculate" => [
                "has_recalculation" => false
            ]
        ];
        
        $exchange->save();
        ExchangeStart::dispatch($exchange->id, app()->getLocale(), auth()->user());

        if($direction->merchant_type_from == "manualcash" || $direction->merchant_type_to == "manualcash"){
            $text = "❗️❗️❗️<b>СОЗДАНА ЗАЯВКА НА НАЛИЧКУ</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
            sendTelegramNotification($text);
            return $this->responseSuccess(false, [
                "open_modal_cashexchange" => true
            ]);
        }
        return $this->responseSuccess(false, [
            "redirect" => route("exchgangePage2", [
                $exchange->hash
            ])
        ]);
    }

    public function view_created(Request $request, $lang, $key){
        if(empty($key) || !is_string($key) || mb_strlen($key) > 255){
            return abort(404);
        }

        $exchange = Exchange::where("hash", $key)->first();
        if(!$exchange || $exchange->status == 12 || $exchange->status == 13){
            return abort(404);
        }

        return view($this->theme.".pages.exchange_2")->with("exchange", $exchange);
    }

    public function set_ipaid(Request $request, $lang, $key){
        if(empty($key) || !is_string($key) || mb_strlen($key) > 255){
            return redirect()->back();
        }

        $exchange = Exchange::where("hash", $key)->first();
        if(!$exchange || $exchange->status != 0){
            return redirect()->back();
        }
        $exchange->status = 1;
        $exchange->created_at = now();
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ОПЛАЧЕНА ПОЛЬЗОВАТЕЛЕМ</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);
        return redirect()->back();
    }
}
