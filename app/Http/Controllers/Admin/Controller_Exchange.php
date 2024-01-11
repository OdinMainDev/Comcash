<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Http\Traits\Misc\HasTelegramMessage;
use App\Jobs\ExchangeWithdraw;
use App\Models\Exchange;
use Illuminate\Http\Request;

class Controller_Exchange extends Controller{
    
    use HasImage, HasTelegramMessage;

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $exchange = Exchange::where("id", $id)->first();
        if(!$exchange)
            return abort(404);
        
        return view("admin.pages.exchange.item")->with("model", $exchange);
    }

    public function process(Request $request) {
        $request->validate([
            "id" => "required|integer",
            "to_address" => "nullable|string|max:255",
            "to_card" => "nullable|string|max:255",
            "manualcrypto" => "nullable|string|max:255",
            "manualfiat" => "nullable|string|max:255",
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

        if($exchange->status == 0 && ($exchange->admin_id == 0 || $exchange->admin_id == auth()->user()->id || !$this->isRootUser())){
            if($request->manualcrypto){
                $exchange->admin_id = auth()->user()->id;
                $data['merchant_from_data'] = [
                    "address" => $request->manualcrypto,
                    "url" => null
                ];
            }

            if($request->manualfiat){
                $exchange->admin_id = auth()->user()->id;
                $data['merchant_from_data'] = [
                    "address" => $request->manualfiat,
                    "url" => null
                ];
            }
        }
        $exchange->data = $data;
        $exchange->save();
        return $this->responseSuccess();
    }

    public function rewithdraw($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || in_array($exchange->status, [15, 4])) return abort(404);
        if($exchange->merchant_type_from == "manualcrypto" || $exchange->merchant_type_from == "manualfiat") return abort(404);
        if($exchange->merchant_type_to == "manualfiat" || $exchange->merchant_type_to == "manualfiat") return abort(404);

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
        if(!$exchange || !in_array($exchange->status, [15, 4, 3, 1])) return abort(404);
        
        $exchange->status = 4;
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ВЫПЛАТА</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);
        return redirect(route("adminExchangeList"));
    }

    public function set_withdraw_complete($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || !in_array($exchange->status, [15, 4])) return abort(404);

        $exchange->status = 5;
        $exchange->save();
        $text = "✅✅✅<b>СТАТУС ЗАЯВКИ - ЗАЯВКА ЗАВЕРШЕНА</b>✅✅✅\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);
        return redirect(route("adminExchangeList"));
    }

    public function set_paid($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || $exchange->status != 0) return abort(404);
        
        $exchange->status = 1;
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ОПЛАЧЕНО</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);
        return redirect(route("adminExchangeList"));
    }
}
