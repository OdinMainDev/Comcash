<?php

namespace App\Http\Controllers;

use App\Http\Traits\Models\HasCache;
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
        return view($this->theme.".pages.knowledgebase.".$name)->with("currencies", $this->getCacheCurrencies());
    }
}
