<?php
     
namespace App\Telegram\Helpers;

use Illuminate\Support\Facades\Config;

trait Keyboards {

    // $separator = ":;:";

    public function keyboardLanguages($language){
        $languages = Config::get("app.languages");
        $response = [];
        foreach($languages as $value){
            $response[__("telegram.language_".$value, [], $language)] = [
                "type" => "callback_data",
                "value" => "setLanguage:;:".$value,
            ];
        }
        
        return $response;
    }
}