<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateWithdraw extends Model
{
    use HasFactory;

    public function getUser(){
        return $this->hasOne(User::class, "id", "user_id");
    }

    public function getCurrency(){
        return $this->hasOne(Currency::class, "id", "currency");
    }
}
