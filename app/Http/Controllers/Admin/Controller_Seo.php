<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Models\HasCache;
use App\Models\Direction;
use App\Models\ExchangerSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Controller_Seo extends Controller
{
    use HasCache;

    private $pages = ["index", "tariffs", "delivery", "reviews", "news", "blog", "support", "company", "faq", "profile", "login", "register", "rules", "sitemap", "cleaning"];
    
    public function view_choose_page() {
        return view("admin.pages.seo.basics")->with("seoPages", $this->pages);
    }

    public function view_basic_page(Request $request, $lang, $page) {
        if(!in_array($page, $this->pages)){
            return abort(404);
        }
        $model = ExchangerSettings::where("key", "seoData")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "seoData";
            $model->value = json_encode([]);
            $model->save();
        }
        $model->value = json_decode($model->value, true);
        return view("admin.pages.seo.basics_item")->with("pagename", $page)->with("model", $model);
    }

    public function basic_process(Request $request) {
        $validators = [
           "pagename" => "required|in:".implode(",", $this->pages)
        ];
        $validators = appendLocalesSEO($validators);
        $request->validate($validators);
        $model = ExchangerSettings::where("key", "seoData")->first();
        if(!$model){
            $model = new ExchangerSettings;
            $model->key = "seoData";
            $model->value = json_encode([]);
        }
        $data = $model->value;
        $data = json_decode($data, true);
        $data[$request->pagename] = getLocalesSeo($request);
        $model->value = json_encode($data);
        $model->save();
        
        Cache::forget("cached-seo-data");
        return $this->responseSuccess();
    }

    public function edit_direction($lang, $id) {
        if(!is_numeric($id))
        return abort(404);

        $model = Direction::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        return view("admin.pages.seo.edit_direction")->with("model", $model);
    }

    public function edit_direction_process(Request $request){
        $validators = [
            "id" => "required|integer",
        ];
        $validators = appendLocalesSEO($validators);
        $request->validate($validators);
        
        $model = Direction::where("id", $request->id)->first();
        if(!$model){
            return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
        }

        $data = $model->data;
        $data['seo'] = getLocalesSeo($request);
        $model->data = $data;
        $model->save();
        return $this->responseSuccess();
    }
}
