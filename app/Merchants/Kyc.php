<?php

namespace App\Merchants;

use App\Http\Traits\Models\HasKyc;
use Illuminate\Validation\ValidationException;

class Kyc {

    use HasKyc;

    public function checkForKyc($cred = false, $card = false, $user_id = false){
        $model = $this->checkKyc($cred, $card, $user_id);
        if(!$model || !$model->check){
            if(!$model){
                $model = $this->prepareKyc($cred, $card, $user_id);
                $model->save();
            }
            throw ValidationException::withMessages(["kyc_required"]);
        }
    } 
}