<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Currency;
use App\Models\Direction;
use App\Models\Merchant;
use Illuminate\Http\Request;

class Controller_Direction extends Controller{
    
    public function add() {
        return view("admin.pages.directions.add");
    }

    public function add_process(Request $request){
        $request->validate([
            "currencyFrom" => "required|array|min:1",
            "currencyFrom.*" => "integer|exists:App\Models\Currency,id",
            "currencyTo" => "required|array|min:1",
            "currencyTo.*" => "integer|exists:App\Models\Currency,id",

            
            "merchantFrom" => "required|exists:App\Models\Merchant,id",
            "merchantTo" => "required|exists:App\Models\Merchant,id",

            "profit_percent" => "required|numeric"
        ]);

        $merchant_from = Merchant::where("id", $request->merchantFrom)->first();
        $merchant_to = Merchant::where("id", $request->merchantTo)->first();
        foreach($request->currencyFrom as $idFrom) {
            $currency_from = Currency::where("id", $idFrom)->first();
            foreach($request->currencyTo as $idTo) {
                $currency_to = Currency::where("id", $idTo)->first();
                if($currency_from->id == $currency_to->id) continue;
                
                $model = new Direction;
                $model->name = $currency_from->name." → ".$currency_to->name;
                $model->currency_from = $currency_from->id;
                $model->currency_to = $currency_to->id;
                $model->merchant_from = $merchant_from->id;
                $model->merchant_to = $merchant_to->id;
                $model->merchant_type_from = $merchant_from->type;
                $model->merchant_type_to = $merchant_to->type;
                $model->status = true;
                $model->profit_percent = $request->profit_percent;
                $model->position = 100;
                $model->data = [];
                $model->save();
            }
        }

        return json_encode([
            "success" => true,
            "title" => __("common.action_success"),
            "data" => [],
            "redirect" => route("adminDirectionList")
        ]);
    }

    public function remove_all() {
        Direction::truncate();
        return redirect(route("adminDirectionList"));
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);

        $model = Direction::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        return view("admin.pages.directions.edit")->with("model", $model);
    }

    public function edit_process(Request $request){
        $validators = [
            "id" => "required|integer",
            "enabled" => "required|boolean",
            "name" => "required|string|max:255",
            "position" => "required|integer|min:1|max:100000",
            "profit_percent" => "required|numeric",
            "min_amount_usd" => "nullable|numeric",
            "max_amount_usd" => "nullable|numeric",
        ];
        $validators = appendLocalesNames($validators);
        $validators = appendLocalesContents($validators);
        $validators = appendLocalesSEO($validators);
        $request->validate($validators);
        
        $model = Direction::where("id", $request->id)->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }

        $model->name = $request->name;
        $model->position = $request->position;
        $model->profit_percent = $request->profit_percent;
        $model->status = $request->enabled;
        $model->data = [
            "titles" => getLocalesTitles($request),
            "content" => getLocalesContents($request),
            "seo" => getLocalesSeo($request),
            "min_amount_usd" => $request->min_amount_usd,
            "max_amount_usd" => $request->max_amount_usd
        ];
        $model->save();
        return $this->responseSuccess();
    }

    public function update_by_currency() {
        return view("admin.pages.directions.update");
    }

    public function update_by_currency_process(Request $request){
        $request->validate([
            "currencyFrom" => "nullable|array",
            "currencyFrom.*" => "integer|exists:App\Models\Currency,id",
            "currencyTo" => "nullable|array",
            "currencyTo.*" => "integer|exists:App\Models\Currency,id",
            
            "merchantFrom" => "nullable|exists:App\Models\Merchant,id",
            "merchantTo" => "nullable|exists:App\Models\Merchant,id",

            "merchantChangeFrom" => "nullable|exists:App\Models\Merchant,id",
            "merchantChangeTo" => "nullable|exists:App\Models\Merchant,id",

            "enabled" => "required|in:0,1,666",
            "position" => "nullable|integer|min:1|max:100000",
            "profit_percent" => "nullable|numeric",

            "min_amount_usd" => "nullable|numeric",
            "max_amount_usd" => "nullable|numeric",
        ]);

        // валидация на хоть какие то данные
        if(!$request->currencyFrom || !is_array($request->currencyFrom) || count($request->currencyFrom) == 0){
            if(!$request->currencyTo || !is_array($request->currencyTo) || count($request->currencyTo) == 0){
                if(!$request->merchantFrom) {
                    if(!$request->merchantTo) {
                        return $this->responseErrorValidation([
                            "currencyFrom[]" => __("common.needsomethingtoupdatedirections"),
                            "currencyTo[]" => __("common.needsomethingtoupdatedirections"),
                            "merchantFrom" => __("common.needsomethingtoupdatedirections"),
                            "merchantTo" => __("common.needsomethingtoupdatedirections"),
                        ]);
                    }
                }
            }
        }

        $query = Direction::with("currencyFrom")->with("currencyTo");
        if($request->currencyFrom && is_array($request->currencyFrom) && count($request->currencyFrom) > 0){
            $query = $query->orWhereIn("currency_from", $request->currencyFrom);
        }

        if($request->currencyTo && is_array($request->currencyTo) && count($request->currencyTo) > 0){
            $query = $query->orWhereIn("currency_to", $request->currencyTo);
        }
        
        if($request->merchantFrom){
            $query = $query->orWhere("merchant_from", $request->merchantFrom);
        }

        if($request->merchantTo){
            $query = $query->orWhere("merchant_to", $request->merchantTo);
        }

        $merchant_from = false;
        $merchant_to = false;
        if($request->merchantChangeFrom){
            $merchant_from = Merchant::where("id", $request->merchantChangeFrom)->first();
        }
        if($request->merchantChangeTo){
            $merchant_to = Merchant::where("id", $request->merchantChangeTo)->first();
        }

        $data_names = getLocalesNames($request);
        $check = false;
        foreach($data_names as $value) {
            if($value) $check = true;
        }
        if(!$check) $data_names = false;
        $data_content = getLocalesContents($request);
        $check = false;
        foreach($data_content as $value) {
            if($value) $check = true;
        }
        if(!$check) $data_content = false;
        $data_seo = getLocalesSeo($request);
        $check = false;
        foreach($data_seo as $value) {
            if($value) $check = true;
        }
        if(!$check) $data_seo = false;

        $query->chunk(25, function($directions) use($request, $data_names, $data_content, $data_seo, $merchant_from, $merchant_to){
            foreach($directions as $direction){
                if(is_numeric($request->position))
                    $direction->position = $request->position;
                if(is_numeric($request->profit_percent))
                    $direction->profit_percent = $request->profit_percent;
                if($request->enabled != "666")
                    $direction->status = $request->enabled == "1";
                if($merchant_from){
                    $direction->merchant_from = $merchant_from->id;
                    $direction->merchant_type_from = $merchant_from->type;
                    
                }
                if($merchant_to){
                    $direction->merchant_to = $merchant_to->id;
                    $direction->merchant_type_to = $merchant_to->type;
                }
                $data = $this->updateDirectionTexts($direction, $data_names, $data_content, $data_seo, true);
               

                if(is_numeric($request->min_amount_usd))
                    $data['min_amount_usd'] = $request->min_amount_usd;
                if(is_numeric($request->max_amount_usd))
                    $data['max_amount_usd'] = $request->max_amount_usd;

                $direction->data = $data;
                $direction->save();
            }
        });

        return json_encode([
            "success" => true,
            "title" => __("common.action_success"),
            "data" => [],
        ]);
    }

    public function replaceDirectionTags($direction, $texts){
        foreach($texts as $lang => $text){
            if(!$text) continue;
            $text = str_replace("{{currency_from}}", $direction->currencyFrom->name, $text);
            $text = str_replace("{{currency_to}}", $direction->currencyTo->name, $text);
            $text = str_replace("{{currency_from_title}}", $direction->currencyFrom->getTitle(), $text);
            $text = str_replace("{{currency_to_title}}", $direction->currencyTo->getTitle(), $text);
            $texts[$lang] = $text;
        }
       
        return $texts;
    }

    public function updateDirectionTexts($direction, $data_names, $data_content, $data_seo, $needUpdate = false) {
        $data = $direction->data;
        if($data_names) {
            if($needUpdate)
                $data["titles"] = $this->replaceDirectionTags($direction, $data_names);
            else
                $data["titles"] = sumArraysWithoutDublicates(@$data["titles"], $this->replaceDirectionTags($direction, $data_names));
        }
        
        if($data_content){
            if($needUpdate)
                $data["content"] = $this->replaceDirectionTags($direction, $data_content);
            else
                $data["content"] = sumArraysWithoutDublicates(@$data["content"], $this->replaceDirectionTags($direction, $data_content));
        }

        if($data_seo) {
            if($needUpdate)
                $data["seo"] = $this->replaceDirectionTags($direction, $data_seo);
            else
                $data["seo"] = sumArraysWithoutDublicates(@$data["seo"], $this->replaceDirectionTags($direction, $data_seo));
        }

        return $data;
    }
}
