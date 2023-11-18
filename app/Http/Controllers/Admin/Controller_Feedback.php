<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\Feedback;
use Illuminate\Http\Request;

class Controller_Feedback extends Controller{
    
    use HasImage;
    
    public function add() {
        return view("admin.pages.feedback.item")->with("model", new Feedback);
    }

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = Feedback::where("id", $id)->first();
        if(!$model)
            return abort(404);
        
        return view("admin.pages.feedback.item")->with("model", $model);
    }

    public function process(Request $request){
        $validators = [
            "id" => "nullable|integer",
            "fullName" => "required|string|max:255",
            "text" => "required|string|max:255",
        ];
        $request->validate($validators);

        $model = new Feedback;
        if($request->has("id") && $request->id){
            $model = Feedback::where("id", $request->id)->first();
            if(!$model){
                return $this->responseErrorValidation(["undefined" => __("common.data_fail")]);
            }
        }

        $model->name = $request->fullName;
        $model->text = $request->text;
        $model->data = "[]";
        $model->save();
        return $this->responseSuccess();
    }

    public function delete($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $model = Feedback::where("id", $id)->first();
        if(!$model)
            return abort(404);

        $model->delete();
        return redirect(route("adminFeedbackList"));
    }
}
