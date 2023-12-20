<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\User;
use Illuminate\Http\Request;

class Controller_KnowledgeBase extends Controller{

    use HasCache;

    public function static_page(Request $request, $language, $name) {
        if(!is_string($name)){
            return abort(404);
        }
        if(!in_array($name, ["delivery", "tariffs", "reviews", "news", "support", "company", "faq"])){
            return abort(404);
        }
        $return = view($this->theme.".pages.knowledgebase.".$name)->with("currencies", $this->getCacheCurrencies());
        if($name == "news")
            $return = $return->with("news", $this->getCacheNews());

        if($name == "reviews")
            $return = $return->with("feedbacks", $this->getCacheFeedbacks());

        if($name == "tariffs")
            $return = $return->with("tariffs", $this->getCacheExportJson())->with("controller", $this);

        return $return;
    }

    public function support(Request $request){
        $request->validate([
            "message" => "required|string|max:1000",
            "exchange_id" => "nullable|integer",
            "name" => "required|string|max:255",
            "email" => "required|string|max:255|email"
        ]);

        $text = "⚠️⚠️<b>Контактная форма с сайта</b>⚠️⚠️\n";
        $text .= "Имя: ".$request->name."\n";
        $text .= "Email: ".$request->email."\n";
        

        if($request->exchange_id)
            $text .= "ID обмена: ".$request->exchange_id."\n";

        $user = auth()->user();
        // if(!$user){
        //     $user = User::where('email', $request->email)->first();
        // }

        if($user){
            $text .= "\n";
            if($user->first_name)
                $text .= "Имя (привязанное к аккаунту): ".$user->first_name."\n";
            if($user->second_name)
                $text .= "Отчество (привязанное к аккаунту): ".$user->second_name."\n";
            if($user->last_name)
                $text .= "Фамилия (привязанная к аккаунту): ".$user->last_name."\n";
            $text .= "Email (привязанный к аккаунту): ".$user->email."\n";
        }


        sendTelegramNotification($text);
        return $this->responseSuccess(__("common.support message success"));
    }
}
