<?php
     
namespace App\Http\Traits\Models;

use App\Models\KycCheck;
use Illuminate\Validation\ValidationException;

trait HasKyc {

    public function checkKyc($credential = false, $address = false, $user_id = false){
        if(!$user_id){
            if(@auth()->user()->id){
                $user_id = auth()->user()->id;
            }
        }
        $model = KycCheck::query();
        if($credential && config("app.kyc_credential", true)){
            $credential = mb_strtoupper($credential);
            $model = $model->where("credential", $credential);
        }
        
        if($address && config("app.kyc_address", true)){
            $model = $model->where("address", $address);
        }

        if($user_id && config("app.kyc_user_id", false)){
            $model = $model->where("user_id", $user_id);
        }

        return $model->first();
    }

    public function prepareKyc($credential = false, $address = false, $user_id = false){
        if(!$user_id){
            if(@auth()->user()->id){
                $user_id = auth()->user()->id;
            }
        }
        $model = new KycCheck;
        if($credential && config("app.kyc_credential", true)){
            $credential = mb_strtoupper($credential);
            $model->credential = $credential;
        }
        
        if($address && config("app.kyc_address", true)){
            $model->address = $address;
        }

        if($user_id && config("app.kyc_user_id", false)){
            $model->user_id = $user_id;
        }

        return $model;
    }

    public function checkForKyc($cred = false, $card = false, $user_id = false){
        $model = $this->checkKyc($cred, $card, $user_id);
        if(!$model || !$model->check){
            if(!$model){
                $model = $this->prepareKyc($cred, $card, $user_id);
                $model->save();
            }
            throw ValidationException::withMessages(["kyc_required" => $model->id]);
        }
    } 

}