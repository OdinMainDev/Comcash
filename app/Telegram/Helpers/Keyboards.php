<?php
     
namespace App\Telegram\Helpers;

use Illuminate\Support\Facades\Config;

trait Keyboards {

    // $separator = ":;:";

    public function keyboardLanguages($language){
        $languages = Config::get("app.languages");
        $response = [];
        foreach($languages as $value){
            $response[__("telegram.language_".$value)] = [
                "type" => "callback_data",
                "value" => "setLanguage:;:".$value,
            ];
        }
        
        return $response;
    }

    public function keyboardRules($language){
        $response = [];
        $response[__("telegram.decline_rules")] = [
            "type" => "callback_data",
            "value" => "setRules:;:false",
        ];
        $response[__("telegram.accept_rules")] = [
            "type" => "callback_data",
            "value" => "setRules:;:true",
        ];
        
        return $response;
    }
}