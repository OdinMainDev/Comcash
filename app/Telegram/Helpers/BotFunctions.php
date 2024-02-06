<?php
     
namespace App\Telegram\Helpers;
 
use Illuminate\Support\Facades\Config;

trait BotFunctions {

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

    public function checkUserRules() {
        if($this->user->is_rules_accepted){
            return true;
        }
        return false;
    }
}