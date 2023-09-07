<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Controller_Merchant extends Controller
{

    use HasImage;
    
    public function add() {
        $model = new Merchant;
        $model->status = true;
        $model->is_auto = true;
        return view("admin.pages.merchants.item")->with("model", $model);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = Merchant::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        return view("admin.pages.merchants.item")->with("model", $model);
    }

    public function process(Request $request){
        $request->validate([
            "name" => "required|string|max:255",
            "type" => "required|string|in:".implode(",", Config::get("app.merchants")),
            "enabled" => "required|boolean",
            "auto" => "required|boolean",
            "apiKey" => "nullable|string",
            "apiSecret" => "nullable|string",
            "apiToken" => "nullable|string",
            "id" => "nullable|integer|min:0"
        ]);

        $model = new Merchant;
        if($request->has("id") && $request->id){
            $model = Merchant::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
        }

        $model->name = $request->name;
        $model->type = $request->type;
        $model->status = $request->enabled;
        $model->is_auto = $request->auto;
        $model->key = $request->apiKey;
        $model->secret = $request->apiSecret;
        $model->token = $request->apiToken;
        $model->save();

        return $this->responseSuccess();
    }
}
