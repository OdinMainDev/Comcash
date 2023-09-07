<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use App\Models\Direction;
use Illuminate\Http\Request;

class Controller_Direction extends Controller{
    
    public function add() {
        return view("admin.pages.directions.add");
    }

    public function add_process(Request $request){
        $request->validate([
            "currencyFrom" => "required|exists:App\Models\Currency,id",
            "merchantFrom" => "required|exists:App\Models\Merchant,id",
            "currencyTo" => "required|exists:App\Models\Currency,id",
            "merchantTo" => "required|exists:App\Models\Merchant,id",
        ]);

        $currency_from = Currency::where("id", $request->currencyFrom)->first();
        $currency_to = Currency::where("id", $request->currencyTo)->first();

        $model = new Direction;
        $model->name = $currency_from->name." → ".$currency_to->name;
        $model->currency_from = $currency_from->id;
        $model->currency_to = $currency_to->id;
        $model->merchant_from = $request->merchantFrom;
        $model->merchant_to = $request->merchantTo;
        $model->save();

        return json_encode([
            "success" => true,
            "title" => __("common.action_success"),
            "data" => [],
            "redirect" => route("adminDirectionEdit", [$model->id])
        ]);
    }
}
