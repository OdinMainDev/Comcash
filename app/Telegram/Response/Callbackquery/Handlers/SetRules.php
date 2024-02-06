<?php
     
namespace App\Telegram\Response\Callbackquery\Handlers;

trait SetRules {

    public function setRules($choice){
        if($choice == "false"){
            return false;
        }

        $this->user->is_rules_accepted = true;
        $this->user->save();
        return true;
    }
}