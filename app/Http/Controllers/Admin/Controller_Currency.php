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
        $model->data = [
            "titles" => getLocalesNames($request),
            "wallets" => $request->currencyWallets ? $request->currencyWallets : []
        ];
        $model->status = $request->enabled;
        $model->tag = $request->tag;
        $model->save();
        return $this->responseSuccess();
    }
}
