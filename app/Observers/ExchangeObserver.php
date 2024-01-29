<?php

namespace App\Observers;

use App\Jobs\OnExchangeComplete;
use App\Models\Exchange;

class ExchangeObserver{
    //

    public function updating(Exchange $exchange){
        if($exchange->status != 5){
            return;
        }
        OnExchangeComplete::dispatch($exchange->id);
    }
}
