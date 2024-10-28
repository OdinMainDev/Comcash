<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Misc\HasImage;
use App\Http\Traits\Misc\HasTelegramMessage;
use App\Jobs\ExchangeWithdraw;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Controller_Exchange extends Controller{
    
    use HasImage, HasTelegramMessage;

    public function edit($lang, $id) {
        if(!is_numeric($id))
            return abort(404);
        
        $exchange = Exchange::where("id", $id)->first();
        if(!$exchange)
            return abort(404);
        
        return view("admin.pages.exchange.item")->with("model", $exchange)->with("isRootUser", $this->isRootUser());
    }

    public function process(Request $request) {
        $request->validate([
            "id" => "required|integer",
            "to_address" => "nullable|string|max:255",
            "to_card" => "nullable|string|max:255",
            "manualcrypto" => "nullable|string|max:255",
            "manualfiat" => "nullable|string|max:255",
        ]);

        $needToSendMessage = false;
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
            $needToSendMessage = false;
            if($request->manualcrypto){
                $exchange->admin_id = auth()->user()->id;
                if(!isset($data['merchant_from_data']) || !isset($data['merchant_from_data']['address']) || !$data['merchant_from_data']['address']){
                    $data['merchant_from_data'] = [
                        "address" => $request->manualcrypto,
                        "url" => null
                    ];
                    $needToSendMessage = true;
                }
            }

            if($request->manualfiat){
                $exchange->admin_id = auth()->user()->id;
                if(!isset($data['merchant_from_data']) || !isset($data['merchant_from_data']['address']) || !$data['merchant_from_data']['address']){
                    $data['merchant_from_data'] = [
                        "address" => $request->manualfiat,
                        "url" => null
                    ];
                    $needToSendMessage = true;
                }
            }
        }
        $exchange->data = $data;
        $exchange->save();

        if($needToSendMessage){
            $user = $exchange->getUser;
            $botUsers = $user->getTelegramUsers;
            foreach($botUsers as $botUser){
                $language = $botUser->language;
                $text = $this->tgUserExchangeStartMessage($exchange, $language);
                sendTelegramBotUserMessage($text, $botUser, $botUser->getBot, $exchange->id);
                sendTelegramBotUserMessage($exchange->data['merchant_from_data']['address'], $botUser, $botUser->getBot);
                sendTelegramBotUserMessage($exchange->data['amount_data']['amount_send'], $botUser, $botUser->getBot);
            }
        }
        return $this->responseSuccess();
    }

    public function rewithdraw($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || in_array($exchange->status, [15, 4])) return abort(404);
        if($exchange->merchant_type_from == "manualcrypto" || $exchange->merchant_type_from == "manualfiat") return abort(404);
        if($exchange->merchant_type_to == "manualfiat" || $exchange->merchant_type_to == "manualfiat") return abort(404);

        if($exchange->admin_id == 0 && !$this->isRootUser()){
            $exchange->admin_id = auth()->user()->id;
        }
        $exchange->status = 3;
        $exchange->save();
        ExchangeWithdraw::dispatch($exchange->id);
        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function checkexchlocal($id){
        if(!is_numeric($id))
            return false;
        
        return Exchange::where("id", $id)->first();
    }

    public function set_withdraw($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || !in_array($exchange->status, [15, 4, 3, 1])) return abort(404);
        if(!$this->checkUserCanUpdateExchange($exchange))  return abort(404);

        if($exchange->admin_id == 0 && !$this->isRootUser()){
            $exchange->admin_id = auth()->user()->id;
        }
        $exchange->status = 4;
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ВЫПЛАТА</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        $user = $exchange->getUser;
        $botUsers = $user->getTelegramUsers;
        foreach($botUsers as $botUser){
            $language = $botUser->language;
            $text = $this->tgUserExchangeStartWithdrawMessage($language);
            sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
        }

        $this->restoreWalletsAddress($exchange, false);
        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function set_withdraw_complete($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || !in_array($exchange->status, [15, 4])) return abort(404);
        if(!$this->checkUserCanUpdateExchange($exchange))  return abort(404);

        if($exchange->admin_id == 0 && !$this->isRootUser()){
            $exchange->admin_id = auth()->user()->id;
        }
        $exchange->status = 5;
        $exchange->save();
        $text = "✅✅✅<b>СТАТУС ЗАЯВКИ - ЗАЯВКА ЗАВЕРШЕНА</b>✅✅✅\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        $user = $exchange->getUser;
        $botUsers = $user->getTelegramUsers;
        foreach($botUsers as $botUser){
            $language = $botUser->language;
            $text = $this->tgUserExchangeCompleteWithdrawMessage($exchange, $language);
            sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
        }

        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function set_paid($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange || $exchange->status != 0) return abort(404);
        if(!$this->checkUserCanUpdateExchange($exchange)) return abort(404);
        
        if(!isset($exchange->data['merchant_from_data']) || !isset($exchange->data['merchant_from_data']['address']) || !$exchange->data['merchant_from_data']['address']) return abort(404);
        
        $exchange->admin_id = auth()->user()->id;
        $exchange->status = 1;
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА ОПЛАЧЕНО</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        $user = $exchange->getUser;
        $botUsers = $user->getTelegramUsers;
        foreach($botUsers as $botUser){
            $language = $botUser->language;
            $text = $this->tgUserExchangeIPaidMessage($language);
            sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
        }

        $this->restoreWalletsAddress($exchange, false);
        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function checkUserCanUpdateExchange($exchange) {
        if($this->isRootUser()) return true;
        if(auth()->user()->can("handle-all-exchanges")) return true;

        if(auth()->user()->id != $exchange->admin_id && $exchange->admin_id != 0) return false;
        if(!@$exchange->data || !isset($exchange->data['merchant_from_data'])) return true;
        if(!@$exchange->data['merchant_from_data']['address']) return false;

        return true;
    }

    public function set_deleted($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange) return abort(404);
        // if(!$this->isRootUser()) return abort(404);

        if($exchange->admin_id == 0 && !$this->isRootUser()){
            $exchange->admin_id = auth()->user()->id;
        }
        
        $exchange->status = 13;
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА УДАЛЕНА</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        $user = $exchange->getUser;
        $botUsers = $user->getTelegramUsers;
        foreach($botUsers as $botUser){
            $language = $botUser->language;
            $text = $this->tgUserExchangeDeleteMessage($exchange, $language);
            sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
        }

        $this->restoreWalletsAddress($exchange, false);
        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function set_created($lang, $id){
        $exchange = $this->checkexchlocal($id);
        if(!$exchange) return abort(404);
        if(!$this->isRootUser()) return abort(404);
        
        $exchange->admin_id = 0;
        $exchange->status = 0;
        $exchange->created_at = now();
        $exchange->updated_at = now();
        $exchange->save();
        $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА СОЗДАНА</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
        sendTelegramNotification($text);

        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function set_closed_all() {
        $query = Exchange::whereIn("status", [0, 1]);
        if(!$this->isRootUser()){
            $query = $query->where(function($q){
                $q->where("admin_id", 0)->orWhere("admin_id", auth()->user()->id);
            });
        }

        $query = $query->get();
        foreach($query as $exchange){
            if($exchange->admin_id == 0 && !$this->isRootUser()){
                $exchange->admin_id = auth()->user()->id;
            }
            $exchange->status = 13;
            $exchange->save();
            $text = "❗️❗️❗️<b>СТАТУС ЗАЯВКИ ИЗМЕНЕН НА УДАЛЕНА</b>❗️❗️❗️\n".$this->tgBasicMessage($exchange);
            sendTelegramNotification($text);
            $this->restoreWalletsAddress($exchange, false);

            $user = $exchange->getUser;
            if($user){
                $botUsers = $user->getTelegramUsers;
                foreach($botUsers as $botUser){
                    $language = $botUser->language;
                    $text = $this->tgUserExchangeDeleteMessage($exchange, $language);
                    sendTelegramBotUserMessage($text, $botUser, $botUser->getBot);
                }
            }else{
                info("CHECK THIS EXCHANGE ID, ".$exchange->id);
            }
        }
        return redirect(route("adminExchangeList", ["id" => 0]));
    }

    public function restoreWalletsAddress($exchange, $with_restore) {
        $currency = $exchange->currencyFrom;
        $currencyData = $currency->data;
       
        if(isset($currencyData['walletsAvail']) && is_array($currencyData['walletsAvail'])){
            $availAddresses = $currencyData['wallets'];
            $address = $exchange->data['merchant_from_data']['address'];
            if($address) {
                if(!is_array($availAddresses) || in_array($address, $availAddresses)){
                    $currencyData['walletsAvail'][] = $address;
                }
            }
            if($with_restore && (!is_array($availAddresses) || count($currencyData['walletsAvail']) == 0)){
                if(!isset($currencyData['wallets']) || !is_array($currencyData['wallets'])){
                    sendTelegramNotification("ВНИМАНИЕ ПРОИЗОШЛА ВНУТРЕННЯЯ ОШИБКА!!!! ПЕРЕЗАПОЛНИТЕ КОШЕЛЬКИ ДЛЯ ВАЛЮТЫ: ".$exchange->currencyFrom->name);
                }else{
                    $currencyData['walletsAvail'] = $currencyData['wallets'];
                }
            }
            $currency->data = $currencyData;
            $currency->save();
            // Cache::forget("currencies-public");
        }
    }
}
