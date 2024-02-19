<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\Request;

class Controller_KnowledgeBase extends Controller{

    use HasCache;

    public function static_page(Request $request, $language, $name) {
        if(!is_string($name)){
            return abort(404);
        }
        if(!in_array($name, ["delivery", "tariffs", "reviews", "news", "support", "company", "faq", "blog", "rules"])){
            return abort(404);
        }
        $return = view($this->theme.".pages.knowledgebase.".$name)->with("currencies", $this->getCacheCurrencies());
        if($name == "news")
            $return = $return->with("news", $this->getCacheNews());

        if($name == "blog")
            $return = $return->with("news", $this->getCacheNews(true));

        if($name == "reviews")
            $return = $return->with("feedbacks", $this->getCacheFeedbacks());

        if($name == "tariffs")
            $return = $return->with("tariffs", $this->getCacheExportJson())->with("controller", $this);

        $this->setSeoData($this->constructSeoData("comcashPage", $name, $this->getCachedSeoData()), [$name]);
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
        
        $user = auth()->user();
        if($request->exchange_id){
            if($user){
                $exchange = Exchange::where("user_id", $user->id)->where("id", $request->exchange_id)->first();
                if($exchange){
                    $text .= "ID обмена: ".$request->exchange_id." (Настоящий id)\n";
                }else{
                    $text .= "ID обмена: ".$request->exchange_id." (Внимание юзер ввел фейковый id)\n";
                }
            }else{
                $text .= "ID обмена: ".$request->exchange_id." (Внимание юзер ввел (вероятно) фейковый id)\n";
            }
        }


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

    public function news_item(Request $request, $language, $id){
        if(!$id || !is_numeric($id)){
            return abort(404);
        }

        $newsItem = $this->getCacheNewsItem($id);
        if(!$newsItem || $newsItem->is_blog){
            return abort(404);
        }
        $lang = mb_strtolower(app()->getLocale());
        $seo_data = [
            "page" => "comcashNewsItem",
            "title" => @$newsItem->data['seo']['titles'][$lang] ? $newsItem->data['seo']['titles'][$lang] : ucfirst($this->theme),
            "description" => @$newsItem->data['seo']['titles'][$lang] ? $newsItem->data['seo']['titles'][$lang] : ucfirst($this->theme),
            "keywords" => @$newsItem->data['seo']['titles'][$lang] ?  explode(",", str_replace(' ', '', $newsItem->data['seo']['titles'][$lang])) : [ucfirst($this->theme)]
        ];

        $this->setSeoData($seo_data, [$id]);
        return view($this->theme.".pages.knowledgebase.news_item")->with("news", $newsItem);
    }

    public function blog_item(Request $request, $language, $id){
        if(!$id || !is_numeric($id)){
            return abort(404);
        }

        $newsItem = $this->getCacheNewsItem($id);
        if(!$newsItem || !$newsItem->is_blog){
            return abort(404);
        }
        $lang = mb_strtolower(app()->getLocale());
        $seo_data = [
            "page" => "comcashBlogItem",
            "title" => @$newsItem->data['seo']['titles'][$lang] ? $newsItem->data['seo']['titles'][$lang] : ucfirst($this->theme),
            "description" => @$newsItem->data['seo']['titles'][$lang] ? $newsItem->data['seo']['titles'][$lang] : ucfirst($this->theme),
            "keywords" => @$newsItem->data['seo']['titles'][$lang] ?  explode(",", str_replace(' ', '', $newsItem->data['seo']['titles'][$lang])) : [ucfirst($this->theme)]
        ];

        $this->setSeoData($seo_data, [$id]);
        return view($this->theme.".pages.knowledgebase.news_item")->with("news", $newsItem);
    }
}
