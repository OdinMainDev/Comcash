<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_Currency extends Controller{
    
    use HasImage;
    
    public function add() {
        return view("admin.pages.currency.item")->with("model", new Currency);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $currency = Currency::where("id", $id)->first();
        if(!$currency)
            return abort(404);
        
        return view("admin.pages.currency.item")->with("model", $currency);
    }

    public function process(Request $request){
        $validators = [
            "image" => "nullable|".echo_image_validation(),
            "currencyCode" => "required|string|max:255",
            "currencyUnits" => "required|integer|min:0",
            "enabled" => "required|boolean",
            "id" => "nullable|integer",
            "tag" => "required|string|max:255",
            "currencyWallets" => "nullable|array",
            "currencyWallets.*" => "string|max:255",
            "position" => "required|integer|min:1|max:10000"
        ];
        $validators = appendLocalesNames($validators);
        $request->validate($validators);

        $model = new Currency;
        if($request->has("id") && $request->id){
            $model = Currency::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
        }

        $model->name = $request->currencyCode;
        $model->units = $request->currencyUnits;
        $image = $this->uploadImage($request);
        if($image)
            $model->image = $image;
        $data = $model->data;
        if(!is_array($data)) {
            $data = [
                "titles" => getLocalesNames($request),
                "wallets" => $request->currencyWallets ? $request->currencyWallets : [],
                "walletsAvail" => $request->currencyWallets ? $request->currencyWallets : [] // если заканчиваются wallets то он обновляет список из этих же адресов
            ];
        }
        $data["titles"] = getLocalesNames($request);
        if(($request->currencyWallets && count($request->currencyWallets) > 0) && $request->currencyWallets != $data["walletsAvail"]) {
            $data["wallets"] = $request->currencyWallets;
            $data["walletsAvail"] = $request->currencyWallets;
        }
        $model->data = $data;
        $model->status = $request->enabled;
        $model->tag = $request->tag;
        $model->position = $request->position;
        $model->save();
        return $this->responseSuccess();
    }

    public function remove_wallets() {
        $models = Currency::get();
        foreach($models as $model) {
            $data = $model->data;
            $data['wallets'] = [];
            $data['walletsAvail'] = [];
            $model->data = $data;
            $model->save();
        }
        return redirect(route("adminCurrencyList"));
    }

    public function mass_update() {
        return view("admin.pages.currency.update");
    }

    public function mass_update_process(Request $request) {
        $request->validate([
            "currencies" => "required|array",
            "currencies.*" => "integer|exists:App\Models\Currency,id",
            "currencyWallets" => "required|array",
            "currencyWallets.*" => "string|max:255",
        ]);

        $models = Currency::whereIn("id", $request->currencies)->get();
        foreach($models as $model) {
            $data = $model->data;
            if(is_array($request->currencyWallets) && count($request->currencyWallets) > 0){
                $data['wallets'] = $request->currencyWallets;
                $data['walletsAvail'] = $request->currencyWallets;
            }
            $model->data = $data;
            $model->save();
        }
        return $this->responseSuccess();
    }
}
