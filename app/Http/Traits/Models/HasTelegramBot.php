<?php
     
namespace App\Http\Traits\Models;

use App\Models\TelegramBot;
use App\Models\TelegramUser;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

trait HasTelegramBot {

    public function getTelegramBotModel($id){
        return TelegramBot::where("id", $id)->where("status", true)->first();
    }

    public function getUserBotModel($data, $bot) 
    {
        $user = TelegramUser::with("getBot")->with("getUser")->where("telegram_id", $data->getId())->where("bot_id", $bot['id'])->first();
        if(!$user){
            $exchangerUser = User::where("telegram_id", $data->getId())->first();
            if(!$exchangerUser){
                $exchangerUser = new User;
                $exchangerUser->email = "@exchanger.bot.".$data->getUsername();
                $exchangerUser->password = Hash::make(time().uniqid());
                $exchangerUser->first_name = $data->getFirstName();
                $exchangerUser->last_name = $data->getLastName();
                $exchangerUser->telegram = $data->getUsername();
                $exchangerUser->save();
            }

            $user = new TelegramUser;
            $user->username = $data->getUsername();
            $user->telegram_id = $data->getId();
            $user->bot_id = $bot['id'];
            $user->first_name = $data->getFirstName();
            $user->last_name = $data->getLastName();
            $user->is_premium = boolval($data->getIsPremium());
            $user->register_date = time();
            $user->language = $bot['language'];
            $user->is_rules_accepted = Config::get("app.telegram_has_rules");
            $user->save();
            $user->IsNowRegistered = true;
            $user->getUser = $exchangerUser;
        }

        $hasChanges = false;
        if($user->username != $data->getUsername()){
            $hasChanges = true;
            $user->username = $data->getUsername();
            $user->getUser->username = $data->getUsername();
        }
        if($user->first_name != $data->getFirstName()){
            $hasChanges = true;
            $user->first_name = $data->getFirstName();
            $user->getUser->first_name = $data->getFirstName();
        }
        if($user->last_name != $data->getLastName()){
            $hasChanges = true;
            $user->last_name = $data->getLastName();
            $user->getUser->last_name = $data->getLastName();
        }
        if($user->is_premium != boolval($data->getIsPremium())){
            $hasChanges = true;
            $user->is_premium = boolval($data->getIsPremium());
        }
        if($hasChanges) {
            $user->save();
            $user->getUser->save();
        } 
        
        return $user;
    }
}