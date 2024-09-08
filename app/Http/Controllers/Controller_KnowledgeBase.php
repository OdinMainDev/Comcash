<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
use App\Models\Exchange;
use App\Models\User;
use Illuminate\Http\Request;

class Controller_KnowledgeBase extends Controller{

    use HasCache;

    public function static_page(Request $request, $language, $name) {
        $availPages = ["delivery", "tariffs", "reviews", "news", "support", "company", "faq", "blog", "rules", "sitemap", "cleaning", "reputation"];
        if(!is_string($name)){
            return abort(404);
        }
        if(!in_array($name, $availPages)){
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

        if($name == "sitemap")
            $return = $return->with("directions", $this->getCacheDirections())->with("availPages", $availPages);

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

        $text .= "Сообщение: ".$request->message."\n";

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

    public function cleaning(Request $request){
        $request->validate([
            "contactjabber" => "required_without:contacttox|nullable|email|string|max:255",
            "contacttox" => "required_without:contactjabber|nullable|string|min:65|max:85|regex:/^[a-fA-F0-9:]+$/",
        ]);

        if(preg_match('/^[0-9A-Fa-f]{70-80}$/', $request->contacttox) || preg_match('/^[0-9A-Fa-f]{45-55}$/', $request->contacttox)){
            return abort(419);
        }

        $text = "⚠️⚠️<b>Контактная форма с сайта (tox,jabber)</b>⚠️⚠️\n";
        if($request->contactjabber)
            $text .= "Jabber: ".$request->contactjabber."\n";
        if($request->contacttox)
            $text .= "Tox: ".$request->contacttox."\n";
        
        $user = auth()->user();

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


        sendTelegramNotificationContacts($text);
        return $this->responseSuccess(__("common.support message success"));
    }
}
