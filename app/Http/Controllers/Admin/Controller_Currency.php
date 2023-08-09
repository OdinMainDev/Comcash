<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use Illuminate\Http\Request;

class Controller_Currency extends Controller
{

    use HasImage;
    
    public function add() {
        return view("admin.pages.currency.item")->with("model", new Currency);
    }

    public function process(Request $request){
        $validators = [
            "image" => "nullable|".echo_image_validation(),
            "currencyCode" => "required|string|max:255",
            "currencyUnits" => "required|integer|min:0",
            "id" => "nullable|integer"
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
            "titles" => [
                getLocalesNames($request)
            ]
        ];
        $model->save();
        return $this->responseSuccess();
    }
}
