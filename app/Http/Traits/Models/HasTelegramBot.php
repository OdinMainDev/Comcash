<?php
     
namespace App\Http\Traits\Models;

use App\Models\TelegramBot;

trait HasTelegramBot {

    public function getTelegramBotModel($id){
        return TelegramBot::where("id", $id)->where("status", true)->first();
    }
}