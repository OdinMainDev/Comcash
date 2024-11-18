<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Models\ExchangerSettings;
use App\Models\Feedback;
use Illuminate\Http\Request;

class Controller_Settings extends Controller{
    
    use HasImage;
    
    public function view() {
        $settings = ExchangerSettings::where("key", "floating_rates_by_usd")->first();
        return view("admin.pages.settings.rates")->with("settings", $settings ? json_decode($settings->value) : []);
    }

    public function process(Request $request){
        $validators = [
            'repeater.*.amount' => 'required|numeric|gt:0',
            'repeater.*.fee' => 'required|numeric|between:-100,100',
        ];
        $request->validate($validators);

        $settings = ExchangerSettings::where("key", "floating_rates_by_usd")->first();
        if(!$settings){
            $settings = new ExchangerSettings;
        }

        $settings->key = "floating_rates_by_usd";
        $settings->value = json_encode($request->repeater);
        $settings->save();
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
