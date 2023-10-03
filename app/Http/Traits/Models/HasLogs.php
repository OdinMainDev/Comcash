<?php
     
namespace App\Http\Traits\Models;

use App\Models\MerchantLog;

trait HasLogs {

    public function createMerchantLog($merchant_id, $exchange_id, $action, $url, $request, $response){
        if(!is_string($request)){
            $request = json_encode($request);
        }
        if(!is_string($response)){
            $response = json_encode($response);
        }

        $log = new MerchantLog;
        $log->merchant_id = $merchant_id;
        $log->exchange_id = $exchange_id;
        $log->action = $action;
        $log->url = $url;
        $log->request = $request;
        $log->response = $response;
        $log->save();
    }
}