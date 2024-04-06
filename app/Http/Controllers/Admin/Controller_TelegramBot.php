<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TelegramBot;
use App\Telegram\Helpers\RegisterWebhook;
use Illuminate\Http\Request;

class Controller_TelegramBot extends Controller{
    
    public function add() {
        return view("admin.pages.telegram.item")->with("model", new TelegramBot);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = TelegramBot::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        return view("admin.pages.telegram.item")->with("model", $model);
    }

    public function process(Request $request){
        $request->validate([
            "id" => "nullable|integer",
            "username" => "required|string|max:255",
            "token" => "required|string|max:255",
            "enabled" => "required|boolean",
        ]);

        $model = new TelegramBot;
        $check = TelegramBot::where("token", $request->token);
        if($request->has("id") && $request->id){
            $model = TelegramBot::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
            $check = $check->where("id", "!=", $model->id);
        }
        $check = $check->first();

        if($check) {
            return $this->responseErrorValidation(["undefined" => __("common.token_bot_already_exists")]);
        }

        $model->username = $request->username;
        $model->token = $request->token;
        $model->status = $request->enabled;
        $model->save();

        $handler = new RegisterWebhook($model);
        $handler->process();
        
        return $this->responseSuccess();
    }

    public function delete($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = TelegramBot::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        $model->delete();
        return redirect(route("adminTelegramBotList"));
    }
}
