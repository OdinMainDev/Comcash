<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Blog;
use Illuminate\Http\Request;

class Controller_Blog extends Controller{
    
    use HasImage;
    
    public function add() {
        return view("admin.pages.blog.item")->with("model", new Blog);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = Blog::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        // dd($model);
        return view("admin.pages.blog.item")->with("model", $model);
    }

    public function process(Request $request){
        $validators = [
            "id" => "nullable|integer",
            "enabled" => "required|boolean"
        ];
        $validators = appendLocalesTitles($validators);
        $validators = appendLocalesContents($validators);
        $validators = appendLocalesSEO($validators);
        $request->validate($validators);

        $model = new Blog;
        if($request->has("id") && $request->id){
            $model = Blog::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
        }else{
            $model->created_by = auth()->user()->id;
        }

        $model->status = boolval($request->enabled);
        $model->data = [
            "titles" => getLocalesTitles($request),
            "content" => getLocalesContents($request),
            "seo" => getLocalesSeo($request),
        ];
        $model->save();
        return $this->responseSuccess();
    }
}
