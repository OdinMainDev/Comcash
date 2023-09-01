<?php
     
namespace App\Http\Traits\Models;

use App\Models\ConfirmCode;

trait HasConfirmCode {

    public function createConfirmCode($type, $user_id){
        $code = new ConfirmCode;
        $code->type = $type;
        $code->code = random_int(100000, 99999999);
        $code->hash = md5(uniqid().time()."CCsaltVio");
        $code->user_id = $user_id;
        $code->created_at = time();
        $code->save();

        return $code;
    }

}