<?php
     
namespace App\Services\Bot\Response\Callbackquery\Handlers;

use Illuminate\Support\Facades\Config;

trait SetLanguage {

    public function setLanguage($language){
        if(!in_array($language, Config::get("app.languages"))){
            $language = Config::get("app.locale");
        }
        $this->user->language = $language;
        $this->user->save();
    }
}