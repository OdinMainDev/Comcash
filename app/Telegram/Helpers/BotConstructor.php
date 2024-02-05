<?php
     
namespace App\Telegram\Helpers;
 
use Illuminate\Support\Facades\Config;

trait BotConstructor {

    public function constructBotData(){
        $language = "";
        if($this->getMessage())
            $language = $this->getMessage()->getFrom()->getLanguageCode();
        else if($this->getCallbackQuery())
            $language = $this->getCallbackQuery()->getFrom()->getLanguageCode();

        $languages = Config::get("app.languages");
        if (!in_array($language, $languages))
            $language = Config::get("app.locale");
        
        return [
            "id" => $this->telegram->getBotId(),
            "language" => $language,
        ];
    }
}