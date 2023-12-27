<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Jobs\ExchangeWithdraw;
use App\Models\Exchange;
use Illuminate\Http\Request;

class Controller_Exchange extends Controller{
    
    use HasImage;

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $exchange = Exchange::where("id", $id)->first();
        if(!$exchange)
            return abort(404);

        // dd($exchange);
        
        return view("admin.pages.exchange.item")->with("model", $exchange);
    }

    public function process(Request $request) {
        $request->validate([
            "id" => "required|integer",
        ]);

        $exchange = Exchange::where("id", $request->id)->first();
        if(!$exchange)
            return abort(404);

        $data = $exchange->data;
        if($request->to_address){
            @$data['request_data']['to_address'] = $request->to_address;
        }
        if($request->to_card){
            @$data['request_data']['to_card'] = $request->to_card;
        }
        $exchange->data = $data;
        $exchange->save();
        return $this->responseSuccess();
    }

    public function rewithdraw($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || $exchange->status != 15) return abort(404);

        $exchange->status = 3;
        $exchange->save();
        ExchangeWithdraw::dispatch($exchange->id);
        return redirect(route("adminExchangeList"));
    }

    public function checkexchlocal($id){
        if(!is_numeric($id))
            return false;
        
        return Exchange::where("id", $id)->first();
    }

    public function set_withdraw($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || $exchange->status != 15) return abort(404);

        $exchange->status = 4;
        $exchange->save();
        return redirect(route("adminExchangeList"));
    }

    public function set_withdraw_complete($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || $exchange->status != 15) return abort(404);

        $exchange->status = 5;
        $exchange->save();
        return redirect(route("adminExchangeList"));
    }
}
